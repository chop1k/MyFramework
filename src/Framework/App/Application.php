<?php


namespace Framework\App;

use Exception;
use Framework\Cache\Cache;
use Framework\Controller\Controller;
use Framework\Data\HandlerKit;
use Framework\Exceptions\InvalidResponseException;
use Framework\Exceptions\InvalidSubscriberException;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Middleware\AbstractMiddleware;
use Framework\Middleware\Middleware;
use Framework\Model\DatabaseProvider;
use Framework\Model\ModelsManager;
use Framework\Model\QueryProvider;
use Framework\Routing\Route;
use Framework\Routing\Routes;
use Framework\Subscriber\AbstractSubscriber;
use Framework\Subscriber\Event;
use Framework\Subscriber\Subscriber;
use Framework\Subscriber\Subscribers;

/**
 * Application class that represents request handling
 * @package Framework\App
 */
class Application
{
    /**
     * @var Subscribers $subscribers
     */
    private Subscribers $subscribers;

    /**
     * @return Subscribers
     */
    public function getSubscribers(): Subscribers
    {
        return $this->subscribers;
    }

    /**
     * @param Subscribers $subscribers
     */
    public function setSubscribers(Subscribers $subscribers): void
    {
        $this->subscribers = $subscribers;
    }

    /**
     * @var Route|null $route
     */
    private ?Route $route;

    /**
     * @return Route|null
     */
    public function getRoute(): ?Route
    {
        return $this->route;
    }

    /**
     * @param Route|null $route
     */
    public function setRoute(?Route $route): void
    {
        $this->route = $route;
    }

    /**
     * @var Exception|null $exception
     */
    private ?Exception $exception;

    /**
     * @return Exception|null
     */
    public function getException(): ?Exception
    {
        return $this->exception;
    }

    /**
     * @param Exception|null $exception
     */
    public function setException(?Exception $exception): void
    {
        $this->exception = $exception;
    }

    /**
     * @var HandlerKit $handlerKit
     */
    private HandlerKit $handlerKit;

    /**
     * @return HandlerKit
     */
    public function getHandlerKit(): HandlerKit
    {
        return $this->handlerKit;
    }

    /**
     * @param HandlerKit $handlerKit
     */
    public function setHandlerKit(HandlerKit $handlerKit): void
    {
        $this->handlerKit = $handlerKit;
    }

    /**
     * @var Response|null $response
     */
    private ?Response $response;

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }

    /**
     * @param Response|null $response
     */
    public function setResponse(?Response $response): void
    {
        $this->response = $response;
    }

    /**
     * Application constructor which nullifies some properties
     */
    public function __construct()
    {
        $this->setHandlerKit(new HandlerKit());
        $this->setException(null);
        $this->setRoute(null);
        $this->setResponse(null);
    }

    /**
     * Function for invoke events and get result
     * @param int $event
     * @return Response|null
     * @throws InvalidSubscriberException
     */
    public function invoke(int $event): ?Response
    {
        $event = new Event($event);

        /**
         * Gets method
         */
        if ($event->isMultiple())
            $getMethod = 'get' . $event->getName() . 'Subscribers';
        else
            $getMethod = 'get' . $event->getName() . 'Subscriber';

        /**
         * Executes method and gets list of subscribers or subscriber
         */
        $subscribers = $this->getSubscribers()->$getMethod();

        if (is_array($subscribers))
        {
            $response = null;

            foreach ($subscribers as $subscriber)
            {
                /**
                 * Invoke subscriber
                 */
                $response = $this->invokeOne($subscriber, $event);

                if (!is_null($response))
                    return $response;
            }

            /**
             * If subscriber return response then return response
             */
            return $response;
        }

        /**
         * If subscriber is single then invoke him
         */
        if ($subscribers instanceof Subscriber)
        {
            return $this->invokeOne($subscribers, $event);
        }

        /**
         * If response not returned then gets default response, related with event
         */
        if (!$event->isNullable())
            return Response::getFromStatus($event->getStatus());

        /**
         * If event is Response then return response, which was got earlier
         */
        if ($event === Event::Response)
            return $this->getResponse();

        return null;
    }

    /**
     * Private function for invoke one subscriber
     * @param Subscriber $subscriber
     * @param Event $event
     * @return Response|null
     * @throws InvalidSubscriberException
     */
    private function invokeOne(Subscriber $subscriber, Event $event): ?Response
    {
        /**
         * Gets subscriber instance
         * @var AbstractSubscriber $instance
         */
        $instance = $subscriber->getInstance();

        if (!($instance instanceof AbstractSubscriber) || !is_subclass_of($instance, $event->getInterface()))
            throw new InvalidSubscriberException('subscriber must be instance of ' . AbstractSubscriber::class . ', got ' . gettype($instance));

        /**
         * Sets instance properties
         */
        $instance->request = $this->handlerKit->request;
        $instance->config = $this->handlerKit->config;
        $instance->exception = $this->getException();
        $instance->route = $this->getRoute();
        $instance->response = $this->getResponse();
        $instance->manager = $this->handlerKit->manager;
        $instance->query = $this->handlerKit->query;
        $instance->memcache = $this->handlerKit->memcache;

        /**
         * Gets method for execute
         */
        $method = 'on' . $event->getName();

        return $instance->$method();
    }

    /**
     * Liberates resources which used by application.
     */
    public function free(): void
    {
        /**
         * @var DatabaseProvider $provider
         */
        foreach ($this->handlerKit->manager->getProviders() as $provider)
        {
            if ($provider->isConnected())
            {
                $provider->close();
            }
        }
    }

    /**
     * Function which start application
     * @param ApplicationConfig $config
     * @return Response
     * @throws InvalidSubscriberException
     */
    public static function start(ApplicationConfig $config): Response
    {
        $app = new Application();

        /**
         * Get subscribers
         */
        $app->setSubscribers(Subscribers::fromArray(require_once $config->getSubscribersPath()));

        /**
         * Create request from globals
         */
        $request = Request::createFromGlobals();

        $kit = new HandlerKit();

        $kit->request = $request;
        $kit->config = Config::fromArray(require_once $config->getFrameworkPath());
        $kit->query = QueryProvider::fromConfig(require_once $config->getQueriesPath());
        $kit->manager = ModelsManager::create(require_once $config->getDatabasesPath());

        /**
         * Requires cache config
         */
        $memcache = require_once $config->getCachePath();

        /**
         * If cache is not null then wrap and create instance
         */
        if (!is_null($memcache))
        {
            $memcache = Cache::fromArray($memcache)->getMemcached();
        }

        $kit->memcache = $memcache;

        $app->setHandlerKit($kit);

        /**
         * Local function that need for exclude code copying
         * @param Exception $exception
         * @param Application $app
         * @return Response
         */
        $invokeException = function (Exception $exception, Application $app): Response
        {
            $app->setException($exception);

            $response = $app->invoke(Event::Exception);

            $app->free();

            if (is_null($response))
                throw $exception;

            return $response;
        };

        /**
         * Local function that need for exclude code copying
         * @param Response $response
         * @param Application $app
         * @return Response
         */
        $invokeResponse = function (Response $response, Application $app): Response
        {
            $app->setResponse($response);

            $app->invoke(Event::Response);

            $app->free();

            return $response;
        };

        /**
         * Local function that need for exclude code copying
         * @param bool $before
         * @param array $middleware
         * @param Controller $controller
         * @param Application $app
         * @return bool|Response|mixed|null
         */
        $invokeMiddleware = function (bool $before, array $middleware, Controller $controller, Application $app)
        {
            /**
             * Gets list of middleware
             */
            $list = $before ? $controller->getBeforeMiddleware() : $controller->getAfterMiddleware();

            $response = null;

            foreach ($list as $name)
            {
                /**
                 * If middleware list not contains middleware which indicates in controller then throw exception
                 */
                if (!isset($middleware[$name]))
                    throw new Exception("undefined middleware with name $name");

                /**
                 * Structure middleware
                 */
                $middlewareInstance = Middleware::fromArray($name, $middleware[$name]);

                /**
                 * Gets middleware instance
                 */
                $instance = $middlewareInstance->getInstance();

                /**
                 * Type checking
                 */
                if (!($instance instanceof AbstractMiddleware))
                    throw new Exception('middleware instance must be instance of ' . AbstractMiddleware::class . ', got ' . gettype($instance));

                /**
                 * Sets instance properties
                 */
                $instance->response = $app->getResponse();
                $instance->request = $app->getHandlerKit()->request;
                $instance->config = $app->getHandlerKit()->config;
                $instance->manager = $app->getHandlerKit()->manager;
                $instance->query = $app->getHandlerKit()->query;
                $instance->memcache = $app->getHandlerKit()->memcache;

                /**
                 * Gets method for execute
                 */
                $method = $middlewareInstance->getMethod();

                /**
                 * Execute method
                 */
                $response = $instance->$method();

                /**
                 * If returns type is bool then break loop and return response
                 */
                if (is_bool($response))
                    break;

                /**
                 * Is response is response then return response
                 */
                if ($response instanceof Response)
                    break;
            }

            return $response;
        };

        /**
         * Invoke Request event
         */
        try {
            $response = $app->invoke(Event::Request);

            if (!is_null($response))
                return $invokeResponse($response, $app);

        } catch (Exception $exception) {
            /**
             * If error then invoke Exception event and invoke Response event and return response
             */
            return $invokeResponse($invokeException($exception, $app), $app);
        }

        $route = Routes::find(require_once $config->getRoutesPath(), $request->getUrl()->getPath());

        $app->setRoute($route);

        /**
         * Invoke NotFound event if route not found
         */
        if (is_null($route)) {
            try {
                return $invokeResponse($app->invoke(Event::NotFound), $app);
            } catch (Exception $exception) {
                /**
                 * If error then invoke Exception event and invoke Response event and return response
                 */
                return $invokeResponse($invokeException($exception, $app), $app);
            }
        }

        /**
         * Invoke MethodNotAllowed event if method not allowed
         */
        if (!in_array($request->getMethod(), $route->getMethods())) {
            try {
                return $invokeResponse($app->invoke(Event::MethodNotAllowed), $app);
            } catch (Exception $exception) {
                /**
                 * If error then invoke Exception event and invoke Response event and return response
                 */
                return $invokeResponse($invokeException($exception, $app), $app);
            }
        }

        /**
         * Gets controllers list
         */
        $controllers = require_once $config->getControllersPath();

        /**
         * Check if controller defined, if no then invoke ControllerNotFound event
         */
        if (!isset($controllers[$route->getController()])) {
            try {
                $response = $app->invoke(Event::ControllerNotFound);

                if ($response instanceof Response)
                    return $invokeResponse($response, $app);

                throw new Exception("controller with name {$route->getController()} not defined in {$config->getControllersPath()}");
            } catch (Exception $exception) {
                /**
                 * If error then invoke Exception event and invoke Response event and return response
                 */
                return $invokeResponse($invokeException($exception, $app), $app);
            }
        }

        /**
         * Gets controller from array
         */
        $controller = Controller::fromArray($route->getController(), $controllers[$route->getController()]);

        /**
         * Gets middleware list
         */
        $middleware = require_once $config->getMiddlewarePath();

        /**
         * Invoke before middleware
         */
        try {
            $response = $invokeMiddleware(true, $middleware, $controller, $app);

            if ($response instanceof Response)
                return $invokeResponse($response, $app);
        } catch (Exception $exception)
        {
            /**
             * If error then invoke Exception event and invoke Response event and return response
             */
            return $invokeResponse($invokeException($exception, $app), $app);
        }

        try {
            /**
             * Gets instance of controller
             * @var HandlerKit $instance
             */
            $instance = $controller->getInstance($kit);

            /**
             * Gets method for execute
             */
            $method = $controller->getMethod();

            try {
                /**
                 * Execute method and get response
                 */
                $response = $instance->$method();
            } catch (Exception $exception)
            {
                /**
                 * If exceptions aren't allowed then throw exception.
                 */
                if (!$controller->isExceptions())
                    throw $exception;

                /**
                 * Otherwise invoke Exception event and execute middleware.
                 */
                $response = $invokeException($exception, $app);
            }

            if (!($response instanceof Response))
                throw new InvalidResponseException('response must be instance of ' . Response::class . ', got ' . gettype($response));

            /**
             * Invoke after middleware
             */
            $middlewareResponse = $invokeMiddleware(false, $middleware, $controller, $app);

            /**
             * If middleware returned response then invoke Response event and return response
             */
            if ($middlewareResponse instanceof Response)
                return $invokeResponse($middlewareResponse, $app);

            return $invokeResponse($response, $app);
        } catch (Exception $exception) {
            /**
             * If error then invoke Exception event and invoke Response event and return response
             */
            return $invokeResponse($invokeException($exception, $app), $app);
        }
    }
}