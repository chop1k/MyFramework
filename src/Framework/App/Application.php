<?php


namespace Framework\App;

use Exception;
use Framework\Controller\Controller;
use Framework\Data\HandlerKit;
use Framework\Exceptions\InvalidResponseException;
use Framework\Exceptions\InvalidSubscriberException;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Middleware\AbstractMiddleware;
use Framework\Middleware\Middleware;
use Framework\Routing\Route;
use Framework\Routing\Routes;
use Framework\Subscriber\AbstractSubscriber;
use Framework\Subscriber\Event;
use Framework\Subscriber\Subscriber;
use Framework\Subscriber\Subscribers;

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
     * @var Controller $controller
     */
    private Controller $controller;

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
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

    public function __construct()
    {
        $this->setHandlerKit(new HandlerKit());
        $this->setException(null);
        $this->setRoute(null);
        $this->setResponse(null);
    }

    public function invoke(int $event): ?Response
    {
        $event = new Event($event);

        if ($event->isMultiple())
            $getMethod = 'get' . $event->getName() . 'Subscribers';
        else
            $getMethod = 'get' . $event->getName() . 'Subscriber';

        $subscribers = $this->getSubscribers()->$getMethod();

        if (is_array($subscribers))
        {
            $response = null;

            foreach ($subscribers as $subscriber)
            {
                $response = $this->invokeOne($subscriber, $event);

                if (!is_null($response))
                    return $response;
            }

            return $response;
        }

        if ($subscribers instanceof Subscriber)
        {
            return $this->invokeOne($subscribers, $event);
        }

        if (!$event->isNullable())
            return Response::getFromStatus($event->getStatus());

        if ($event === Event::Response)
            return $this->getResponse();

        return null;
    }

    private function invokeOne(Subscriber $subscriber, Event $event): ?Response
    {
        /**
         * @var AbstractSubscriber $instance
         */
        $instance = $subscriber->getInstance();

        if (!($instance instanceof AbstractSubscriber) || !is_subclass_of($instance, $event->getInterface()))
            throw new InvalidSubscriberException('subscriber must be instance of ' . AbstractSubscriber::class . ', got ' . gettype($instance));


        $instance->request = $this->handlerKit->request;
        $instance->config = $this->handlerKit->config;
        $instance->exception = $this->getException();
        $instance->route = $this->getRoute();
        $instance->response = $this->getResponse();

        $method = 'on' . $event->getName();

        return $instance->$method();
    }

    public static function start(ApplicationConfig $config): Response
    {
        $app = new Application();

        $app->setSubscribers(Subscribers::fromArray(require_once $config->getSubscribersPath()));

        $request = Request::createFromGlobals();

        $kit = new HandlerKit();

        $kit->request = $request;
        $kit->config = Config::fromArray(require_once $config->getFrameworkPath());

        $app->setHandlerKit($kit);

        $invokeException = function (Exception $exception, Application $app): Response
        {
            $app->setException($exception);

            $response = $app->invoke(Event::Exception);

            if (is_null($response))
                throw $exception;

            return $response;
        };

        $invokeResponse = function (Response $response, Application $app): Response
        {
            $app->setResponse($response);

            $app->invoke(Event::Response);

            return $response;
        };

        $invokeMiddleware = function (bool $before, array $middleware, Controller $controller, Application $app)
        {
            $list = $before ? $controller->getBeforeMiddleware() : $controller->getAfterMiddleware();

            $response = null;

            foreach ($list as $name)
            {
                if (!isset($middleware[$name]))
                    throw new Exception("undefined middleware with name $name");

                $middlewareInstance = Middleware::fromArray($name, $middleware[$name]);

                $instance = $middlewareInstance->getInstance();

                if (!($instance instanceof AbstractMiddleware))
                    throw new Exception('middleware instance must be instance of ' . AbstractMiddleware::class . ', got ' . gettype($instance));

                $instance->response = $app->getResponse();
                $instance->request = $app->getHandlerKit()->request;
                $instance->config = $app->getHandlerKit()->config;

                $method = $middlewareInstance->getMethod();

                $response = $instance->$method();

                if (is_bool($response))
                    break;

                if ($response instanceof Response)
                    break;
            }

            return $response;
        };

        try {
            $response = $app->invoke(Event::Request);

            if (!is_null($response))
                return $invokeResponse($response, $app);

        } catch (Exception $exception) {
            return $invokeResponse($invokeException($exception, $app), $app);
        }

        $route = Routes::find(require_once $config->getRoutesPath(), $request->getUrl()->getPath());

        $app->setRoute($route);

        if (is_null($route)) {
            try {
                return $invokeResponse($app->invoke(Event::NotFound), $app);
            } catch (Exception $exception) {
                return $invokeResponse($invokeException($exception, $app), $app);
            }
        }

        if (!in_array($request->getMethod(), $route->getMethods())) {
            try {
                return $invokeResponse($app->invoke(Event::MethodNotAllowed), $app);
            } catch (Exception $exception) {
                return $invokeResponse($invokeException($exception, $app), $app);
            }
        }

        $controllers = require_once $config->getControllersPath();

        if (!isset($controllers[$route->getController()])) {
            try {
                return $invokeResponse($app->invoke(Event::ControllerNotFound), $app);
            } catch (Exception $exception) {
                return $invokeResponse($invokeException($exception, $app), $app);
            }
        }

        if (!isset($controllers[$route->getController()]))
        {
            try {
                throw new Exception("controller with name {$route->getController()} not defined in {$config->getControllersPath()}");
            } catch (Exception $exception) {
                return $invokeResponse($invokeException($exception, $app), $app);
            }
        }

        $controller = Controller::fromArray($route->getController(), $controllers[$route->getController()]);

        $middleware = require_once $config->getMiddlewarePath();

        try {
            $response = $invokeMiddleware(true, $middleware, $controller, $app);

            if ($response instanceof Response)
                return $invokeResponse($response, $app);
        } catch (Exception $exception)
        {
            return $invokeResponse($invokeException($exception, $app), $app);
        }

        $app->setController($controller);

        try {
            /**
             * @var HandlerKit $instance
             */
            $instance = $controller->getInstance($kit);

            $method = $controller->getMethod();

            $response = $instance->$method();

            if (!($response instanceof Response))
                throw new InvalidResponseException('response must be instance of ' . Response::class . ', got ' . gettype($response));

            $middlewareResponse = $invokeMiddleware(false, $middleware, $controller, $app);

            if ($middlewareResponse instanceof Response)
                return $invokeResponse($middlewareResponse, $app);

            return $invokeResponse($response, $app);
        } catch (Exception $exception) {
            return $invokeResponse($invokeException($exception, $app), $app);
        }
    }
}