<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

/**
 * Interface RouteFoundInterface for RouteFound event subscribers.
 * @package Framework\Subscriber
 */
interface RouteFoundInterface
{
    /**
     * Executes when RouteFound event invokes.
     * @return Response|null
     */
    public function onRouteFound(): ?Response;
}