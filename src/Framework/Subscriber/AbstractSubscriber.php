<?php


namespace Framework\Subscriber;


use Exception;
use Framework\Data\HandlerKit;
use Framework\Routing\Route;

/**
 * Class AbstractSubscriber from which inherits subscribers.
 * @package Framework\Subscriber
 */
class AbstractSubscriber extends HandlerKit
{
    /**
     * Contains exception or null.
     * @var Exception|null $exception
     */
    public ?Exception $exception;

    /**
     * Contains route or null.
     * @var Route|null $route
     */
    public ?Route $route;
}