<?php


namespace Framework\Subscriber;


class Event
{
    public const Request = 1;
    public const Exception = 2;
    public const NotFound = 3;
    public const MethodNotAllowed = 4;
    public const RouteFound = 5;
    public const ControllerNotFound = 6;

    public static function getStatus(int $event): int
    {
        switch ($event)
        {
            case Event::NotFound:
                return 404;
            case Event::MethodNotAllowed:
                return 405;
            case Event::Exception:
            case Event::ControllerNotFound:
            default:
                return 500;
        }
    }

    public static function isMultiple(int $event): bool
    {
        switch ($event)
        {
            case self::Request:
            case self::RouteFound:
                return true;
            default:
                return false;
        }
    }
}