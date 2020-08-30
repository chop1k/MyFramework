<?php


namespace Framework\Subscriber;


use Exception;
use Framework\Data\HandlerKit;
use Framework\Routing\Route;

class AbstractSubscriber extends HandlerKit
{
    /**
     * @var Exception $exception
     */
    public Exception $exception;

    /**
     * @var Route $route
     */
    public Route $route;
}