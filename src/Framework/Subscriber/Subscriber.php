<?php


namespace Framework\Subscriber;

/**
 * Class Subscriber represents event subscriber.
 * @package Framework\Subscriber
 */
class Subscriber
{
    /**
     * Contains subscriber name.
     * @var string $name
     */
    private string $name;

    /**
     * Returns subscriber name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets subscriber name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains subscriber class.
     * @var string $class
     */
    private string $class;

    /**
     * Returns subscriber class.
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Sets subscriber class.
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * Contains event number.
     * @var int
     */
    private int $event;

    /**
     * Returns event number.
     * @return int
     */
    public function getEvent(): int
    {
        return $this->event;
    }

    /**
     * Sets event number.
     * @param int $event
     */
    public function setEvent(int $event): void
    {
        $this->event = $event;
    }

    /**
     * Returns subscriber instance.
     * @return object
     */
    public function getInstance(): object
    {
        $class = $this->getClass();

        return new $class();
    }

    /**
     * Shortcut for creating subscriber from array.
     * @param string $name
     * @param array $array
     * @return Subscriber
     */
    public static function fromArray(string $name, array $array): Subscriber
    {
        $subscriber = new Subscriber();

        $subscriber->setName($name);
        $subscriber->setClass($array['class']);
        $subscriber->setEvent($array['event']);

        return $subscriber;
    }
}