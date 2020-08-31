<?php


namespace Framework\Subscriber;


use Exception;

class Event
{
    public const Request = 1;
    public const Exception = 2;
    public const NotFound = 3;
    public const MethodNotAllowed = 4;
    public const RouteFound = 5;
    public const ControllerNotFound = 6;
    public const Response = 7;
    
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
     * @var int $number
     */
    private int $number;

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

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
     * @var string $interface
     */
    private string $interface;

    /**
     * @return string
     */
    public function getInterface(): string
    {
        return $this->interface;
    }

    /**
     * @param string $interface
     */
    public function setInterface(string $interface): void
    {
        $this->interface = $interface;
    }

    /**
     * @var bool $multiple
     */
    private bool $multiple;

    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * @param bool $multiple
     */
    public function setMultiple(bool $multiple): void
    {
        $this->multiple = $multiple;
    }

    /**
     * @var bool $nullable
     */
    private bool $nullable;

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @param bool $nullable
     */
    public function setNullable(bool $nullable): void
    {
        $this->nullable = $nullable;
    }
    
    /**
     * @var int $status
     */
    private int $status;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}