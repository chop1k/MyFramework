<?php


namespace Framework\App;

use Exception;
use Framework\Controller\Controller;
use Framework\Data\HandlerKit;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routing\Route;
use Framework\Routing\Routes;
use Framework\Subscriber\AbstractSubscriber;
use Framework\Subscriber\Event;
use Framework\Subscriber\Subscriber;
use Framework\Subscriber\Subscribers;
use ReflectionClass;

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
     * @var Route $route
     */
    private Route $route;

    /**
     * @return Route
     */
    public function getRoute(): Route
    {
        return $this->route;
    }

    /**
     * @param Route $route
     */
    public function setRoute(Route $route): void
    {
        $this->route = $route;
    }

    /**
     * @var Exception $exception
     */
    private Exception $exception;

    /**
     * @return Exception
     */
    public function getException(): Exception
    {
        return $this->exception;
    }

    /**
     * @param Exception $exception
     */
    public function setException(Exception $exception): void
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

    public function __construct()
    {
        $this->handlerKit = new HandlerKit();
    }

    public function invoke(int $event): ?Response
    {
        $class = new ReflectionClass(Event::class);

        foreach ($class->getConstants() as $name => $value) {
            if ($event !== $value)
                continue;

            $subscribersMethod = 'get' . $name . (Event::isMultiple($value) ? 'Subscribers' : 'Subscriber');

            $subscribers = $this->subscribers->$subscribersMethod();

            $method = 'on' . $name;

            if (is_array($subscribers)) {
                if (count($subscribers) <= 0)
                    return null;

                $response = null;

                foreach ($subscribers as $subscriber) {
                    $response = $this->invokeOne($subscriber, $method);

                    if (!is_null($response))
                        return $response;
                }

                return is_null($response) ? Response::getFromStatus(Event::getStatus($event)) : $response;
            } elseif (!is_null($subscribers)) {
                return $this->invokeOne($subscribers, $method);
            }
            else
                return Response::getFromStatus(Event::getStatus($event));
        }

        return null;
    }

    private function invokeOne(Subscriber $subscriber, string $method): ?Response
    {
        /**
         * @var AbstractSubscriber $instance
         */
        $instance = $subscriber->getInstance();

        if (!($instance instanceof AbstractSubscriber) || !is_subclass_of($instance, $subscriber->getInterface()))
            throw new Exception('fffff'); // TODO: need a normal exception


        $instance->request = $this->handlerKit->request;
        $instance->config = $this->handlerKit->config;

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

        $response = $app->invoke(Event::Request);

        if (!is_null($response))
            return $response;

        $route = Routes::find(require_once $config->getRoutesPath(), $request->getUrl()->getPath());

        $app->setRoute($route);

        if (is_null($route))
        {
            return $app->invoke(Event::NotFound);
        }

        if (!in_array($request->getMethod(), $route->getMethods()))
        {
            return $app->invoke(Event::MethodNotAllowed);
        }

        $controllers = require_once $config->getControllersPath();

        if (!isset($controllers[$route->getController()]))
        {
            return $app->invoke(Event::ControllerNotFound);
        }

        $controller = Controller::fromArray($route->getController(), $controllers[$route->getController()]);

        $app->setController($controller);

        /**
         * @var HandlerKit $instance
         */
        $instance = $controller->getInstance($kit);

        $method = $controller->getMethod();

        $response = $instance->$method();

        if (!($response instanceof Response))
            throw new Exception('gvvfvf');

        return $response;
    }
}