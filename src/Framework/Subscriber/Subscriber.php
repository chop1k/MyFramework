<?php


namespace Framework\Subscriber;


class Subscriber
{
    /**
     * @var string $name
     */
    private string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @var string $class
     */
    private string $class;

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @var int
     */
    private int $event;

    /**
     * @return int
     */
    public function getEvent(): int
    {
        return $this->event;
    }

    /**
     * @param int $event
     */
    public function setEvent(int $event): void
    {
        $this->event = $event;
    }

    public function getInterface(): string
    {
        if ($this->event === Event::Exception)
            return ExceptionInterface::class;
        elseif ($this->event === Event::NotFound)
            return NotFoundInterface::class;
        elseif ($this->event === Event::MethodNotAllowed)
            return MethodNotAllowedInterface::class;
        elseif ($this->event === Event::Request)
            return RequestInterface::class;
        elseif ($this->event === Event::RouteFound)
            return RouteFoundInterface::class;
        elseif ($this->event === Event::ControllerNotFound)
            return ControllerNotFoundInterface::class;

        return '';
    }

    public static function fromArray(string $name, array $array): Subscriber
    {
        $subscriber = new Subscriber();

        $subscriber->setName($name);
        $subscriber->setClass($array['class']);
        $subscriber->setEvent($array['event']);

        return $subscriber;
    }

    public function getInstance(): object
    {
        $class = $this->getClass();

        return new $class();
    }
}