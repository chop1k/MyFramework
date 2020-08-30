<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

interface MethodNotAllowedInterface
{
    public function onMethodNotAllowed(): Response;
}