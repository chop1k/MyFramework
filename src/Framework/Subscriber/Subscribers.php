<?php


namespace Framework\Subscriber;

/**
 * Class Subscribers that needed for easy search subscribers by event.
 * @package Framework\Subscriber
 */
class Subscribers
{
    /**
     * Contains array of Request event subscribers.
     * @var array $requestSubscribers
     */
    private array $requestSubscribers;

    /**
     * Returns array of Request event subscriber.
     * @return array
     */
    public function getRequestSubscribers(): array
    {
        return $this->requestSubscribers;
    }

    /**
     * Addes subscriber to array.
     * @param Subscriber $subscriber
     */
    public function addRequestSubscriber(Subscriber $subscriber): void
    {
        $this->requestSubscribers[] = $subscriber;
    }

    /**
     * Contains Exception event subscriber or null.
     * @var Subscriber|null $exceptionSubscriber
     */
    private ?Subscriber $exceptionSubscriber;

    /**
     * Return Exception event subscriber if exists.
     * @return Subscriber|null
     */
    public function getExceptionSubscriber(): ?Subscriber
    {
        return $this->exceptionSubscriber;
    }

    /**
     * Sets Exception event subscriber.
     * @param Subscriber|null $exceptionSubscriber
     */
    public function setExceptionSubscriber(?Subscriber $exceptionSubscriber): void
    {
        $this->exceptionSubscriber = $exceptionSubscriber;
    }

    /**
     * Contains NotFound event subscriber or null.
     * @var Subscriber|null $notFoundSubscriber
     */
    private ?Subscriber $notFoundSubscriber;

    /**
     * Returns NotFound event subscriber if exists.
     * @return Subscriber|null
     */
    public function getNotFoundSubscriber(): ?Subscriber
    {
        return $this->notFoundSubscriber;
    }

    /**
     * Sets NotFound event subscriber.
     * @param Subscriber|null $notFoundSubscriber
     */
    public function setNotFoundSubscriber(?Subscriber $notFoundSubscriber): void
    {
        $this->notFoundSubscriber = $notFoundSubscriber;
    }

    /**
     * Contains MethodNotAllowed event subscriber or null.
     * @var Subscriber|null $methodNotAllowedSubscriber
     */
    private ?Subscriber $methodNotAllowedSubscriber;

    /**
     * Returns MethodNotAllowed event subscriber if exists.
     * @return Subscriber|null
     */
    public function getMethodNotAllowedSubscriber(): ?Subscriber
    {
        return $this->methodNotAllowedSubscriber;
    }

    /**
     * Sets MethodNotAllowed event subscriber.
     * @param Subscriber|null $methodNotAllowedSubscriber
     */
    public function setMethodNotAllowedSubscriber(?Subscriber $methodNotAllowedSubscriber): void
    {
        $this->methodNotAllowedSubscriber = $methodNotAllowedSubscriber;
    }

    /**
     * Contains array of RouteFound event subscribers.
     * @var array $routeFoundSubscribers
     */
    private array $routeFoundSubscribers;

    /**
     * Returns array of RouteFound event subscribers.
     * @return array
     */
    public function getRouteFoundSubscribers(): array
    {
        return $this->routeFoundSubscribers;
    }

    /**
     * Adds subscriber to array of RouteFound subscribers.
     * @param Subscriber $subscriber
     */
    public function addRouteFoundSubscriber(Subscriber $subscriber): void
    {
        $this->routeFoundSubscribers[] = $subscriber;
    }

    /**
     * Contains ControllerNotFound event subscriber or null.
     * @var Subscriber|null $controllerNotFoundSubscriber
     */
    private ?Subscriber $controllerNotFoundSubscriber;

    /**
     * Return ControllerNotFound event subscriber if exists.
     * @return Subscriber|null
     */
    public function getControllerNotFoundSubscriber(): ?Subscriber
    {
        return $this->controllerNotFoundSubscriber;
    }

    /**
     * Sets ControllerNotFound event subscriber.
     * @param Subscriber|null $controllerNotFoundSubscriber
     */
    public function setControllerNotFoundSubscriber(?Subscriber $controllerNotFoundSubscriber): void
    {
        $this->controllerNotFoundSubscriber = $controllerNotFoundSubscriber;
    }

    /**
     * Contains array of Response event subscribers.
     * @var array $responseSubscribers
     */
    private array $responseSubscribers;

    /**
     * Returns array of Response event subscribers.
     * @return array
     */
    public function getResponseSubscribers(): array
    {
        return $this->responseSubscribers;
    }

    /**
     * Adds subscriber to array of Response event subscribers.
     * @param Subscriber $subscriber
     */
    public function addResponseSubscribers(Subscriber $subscriber): void
    {
        $this->responseSubscribers[] = $subscriber;
    }

    /**
     * Subscribers constructor.
     */
    public function __construct()
    {
        $this->requestSubscribers = [];
        $this->routeFoundSubscribers = [];
        $this->exceptionSubscriber = null;
        $this->notFoundSubscriber = null;
        $this->methodNotAllowedSubscriber = null;
        $this->controllerNotFoundSubscriber = null;
        $this->responseSubscribers = [];
    }

    /**
     * Shortcut for creating instance by array.
     * @param array $array
     * @return Subscribers
     */
    public static function fromArray(array $array): Subscribers
    {
        $subscribers = new Subscribers();

        foreach ($array as $name => $value)
        {
            $subscriber = Subscriber::fromArray($name, $value);

            switch ($subscriber->getEvent())
            {
                case Event::Request:
                    $subscribers->addRequestSubscriber($subscriber); break;
                case Event::Exception:
                    $subscribers->setExceptionSubscriber($subscriber); break;
                case Event::NotFound:
                    $subscribers->setNotFoundSubscriber($subscriber); break;
                case Event::MethodNotAllowed:
                    $subscribers->setMethodNotAllowedSubscriber($subscriber); break;
                case Event::RouteFound:
                    $subscribers->addRouteFoundSubscriber($subscriber); break;
                case Event::ControllerNotFound:
                    $subscribers->setControllerNotFoundSubscriber($subscriber); break;
                case Event::Response:
                    $subscribers->addResponseSubscribers($subscriber); break;
            }
        }

        return $subscribers;
    }
}