<?php


namespace Framework\Subscriber;


class Subscribers
{
    /**
     * @var array $requestSubscribers
     */
    private array $requestSubscribers;

    /**
     * @return array
     */
    public function getRequestSubscribers(): array
    {
        return $this->requestSubscribers;
    }

    /**
     * @param Subscriber $subscriber
     */
    public function addRequestSubscriber(Subscriber $subscriber): void
    {
        $this->requestSubscribers[] = $subscriber;
    }

    /**
     * @var Subscriber|null $exceptionSubscriber
     */
    private ?Subscriber $exceptionSubscriber;

    /**
     * @return Subscriber|null
     */
    public function getExceptionSubscriber(): ?Subscriber
    {
        return $this->exceptionSubscriber;
    }

    /**
     * @param Subscriber|null $exceptionSubscriber
     */
    public function setExceptionSubscriber(?Subscriber $exceptionSubscriber): void
    {
        $this->exceptionSubscriber = $exceptionSubscriber;
    }

    /**
     * @var Subscriber|null $notFoundSubscriber
     */
    private ?Subscriber $notFoundSubscriber;

    /**
     * @return Subscriber|null
     */
    public function getNotFoundSubscriber(): ?Subscriber
    {
        return $this->notFoundSubscriber;
    }

    /**
     * @param Subscriber|null $notFoundSubscriber
     */
    public function setNotFoundSubscriber(?Subscriber $notFoundSubscriber): void
    {
        $this->notFoundSubscriber = $notFoundSubscriber;
    }

    /**
     * @var Subscriber|null $methodNotAllowedSubscriber
     */
    private ?Subscriber $methodNotAllowedSubscriber;

    /**
     * @return Subscriber|null
     */
    public function getMethodNotAllowedSubscriber(): ?Subscriber
    {
        return $this->methodNotAllowedSubscriber;
    }

    /**
     * @param Subscriber|null $methodNotAllowedSubscriber
     */
    public function setMethodNotAllowedSubscriber(?Subscriber $methodNotAllowedSubscriber): void
    {
        $this->methodNotAllowedSubscriber = $methodNotAllowedSubscriber;
    }

    /**
     * @var array $routeFoundSubscribers
     */
    private array $routeFoundSubscribers;

    /**
     * @return array
     */
    public function getRouteFoundSubscribers(): array
    {
        return $this->routeFoundSubscribers;
    }

    /**
     * @param Subscriber $subscriber
     */
    public function addRouteFoundSubscriber(Subscriber $subscriber): void
    {
        $this->routeFoundSubscribers[] = $subscriber;
    }

    /**
     * @var Subscriber|null $controllerNotFoundSubscriber
     */
    private ?Subscriber $controllerNotFoundSubscriber;

    /**
     * @return Subscriber|null
     */
    public function getControllerNotFoundSubscriber(): ?Subscriber
    {
        return $this->controllerNotFoundSubscriber;
    }

    /**
     * @param Subscriber|null $controllerNotFoundSubscriber
     */
    public function setControllerNotFoundSubscriber(?Subscriber $controllerNotFoundSubscriber): void
    {
        $this->controllerNotFoundSubscriber = $controllerNotFoundSubscriber;
    }

    /**
     * @var array $responseSubscribers
     */
    private array $responseSubscribers;

    /**
     * @return array
     */
    public function getResponseSubscribers(): array
    {
        return $this->responseSubscribers;
    }

    /**
     * @param Subscriber $subscriber
     */
    public function addResponseSubscribers(Subscriber $subscriber): void
    {
        $this->responseSubscribers[] = $subscriber;
    }

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