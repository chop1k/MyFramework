<?php


namespace Framework\Subscriber;


use Exception;

/**
 * Class Event represents application event.
 * @package Framework\Subscriber
 */
class Event
{
    /**
     * Invokes when request successfully created from globals.
     */
    public const Request = 1;

    /**
     * Invokes when application catch a exception, it must return response.
     */
    public const Exception = 2;

    /**
     * Invokes when route not found, it must return response.
     */
    public const NotFound = 3;

    /**
     * Invokes when route found, but method not supported. It must return response.
     */
    public const MethodNotAllowed = 4;

    /**
     * Invoke when route found, can be used for handling route parameters. It's multiple and can return null or response.
     */
    public const RouteFound = 5;

    /**
     * Invoke when controller not found. It must return response.
     */
    public const ControllerNotFound = 6;

    /**
     * Invoke when response returned. It multiple and must not return response.
     */
    public const Response = 7;

    /**
     * Event constructor.
     * Sets other properties by given event number.
     * @param int $number
     * @throws Exception
     */
    public function __construct(int $number)
    {
        $this->setNumber($number);

        if ($number === self::Request)
        {
            $this->setInterface(RequestInterface::class);
            $this->setName('Request');
            $this->setStatus(500);
            $this->setNullable(true);
            $this->setMultiple(true);
        }
        elseif ($number === self::Exception)
        {
            $this->setInterface(ExceptionInterface::class);
            $this->setName('Exception');
            $this->setStatus(500);
            $this->setNullable(false);
            $this->setMultiple(false);
        }
        elseif ($number === self::NotFound)
        {
            $this->setInterface(NotFoundInterface::class);
            $this->setName('NotFound');
            $this->setStatus(404);
            $this->setNullable(false);
            $this->setMultiple(false);
        }
        elseif ($number === self::MethodNotAllowed)
        {
            $this->setInterface(MethodNotAllowedInterface::class);
            $this->setName('MethodNotAllowed');
            $this->setStatus(405);
            $this->setNullable(false);
            $this->setMultiple(false);
        }
        elseif ($number === self::RouteFound)
        {
            $this->setInterface(RouteFoundInterface::class);
            $this->setName('RouteFound');
            $this->setStatus(500);
            $this->setNullable(true);
            $this->setMultiple(true);
        }
        elseif ($number === self::ControllerNotFound)
        {
            $this->setInterface(ControllerNotFoundInterface::class);
            $this->setName('ControllerNotFound');
            $this->setStatus(500);
            $this->setNullable(false);
            $this->setMultiple(false);
        }
        elseif ($number === self::Response)
        {
            $this->setInterface(ResponseInterface::class);
            $this->setName('Response');
            $this->setStatus(500);
            $this->setNullable(true);
            $this->setMultiple(true);
        }
        else throw new Exception("event with number = $number does not exists");
    }

    /**
     * Contains event number provided by constants of Event class.
     * @var int $number
     */
    private int $number;

    /**
     * Returns event number.
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * Sets event number.
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * Contains event name.
     * @var string $name
     */
    private string $name;

    /**
     * Returns event name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets event name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains interface::class of interface, that must be implemented by subscriber relevant event.
     * @var string $interface
     */
    private string $interface;

    /**
     * Return interface name.
     * @return string
     */
    public function getInterface(): string
    {
        return $this->interface;
    }

    /**
     * Sets interface name.
     * @param string $interface
     */
    public function setInterface(string $interface): void
    {
        $this->interface = $interface;
    }

    /**
     * Indicates when event is multiple.
     * @var bool $multiple
     */
    private bool $multiple;

    /**
     * Returns true if event is multiple.
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * Sets multiple.
     * @param bool $multiple
     */
    public function setMultiple(bool $multiple): void
    {
        $this->multiple = $multiple;
    }

    /**
     * Indicates when event can return null or void.
     * @var bool $nullable
     */
    private bool $nullable;

    /**
     * Return true if event can return null or void.
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * Sets nullable.
     * @param bool $nullable
     */
    public function setNullable(bool $nullable): void
    {
        $this->nullable = $nullable;
    }
    
    /**
     * Contains the corresponding http status.
     * For example at NotFound event status is 404.
     * @var int $status
     */
    private int $status;

    /**
     * Returns http status of event.
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Sets http status if event.
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}