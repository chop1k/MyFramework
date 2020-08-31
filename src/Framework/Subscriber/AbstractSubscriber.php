<?php


namespace Framework\Subscriber;


use Exception;
use Framework\Data\HandlerKit;
use Framework\Routing\Route;

class AbstractSubscriber extends HandlerKit
{
    /**
     * @var Exception|null $exception
     */
    public ?Exception $exception;

    /**
     * @var Route|null $route
     */
    public ?Route $route;
}