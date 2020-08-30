<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

interface RouteFoundInterface
{
    public function onRouteFound(): ?Response;
}