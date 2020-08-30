<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

interface ControllerNotFoundInterface
{
    public function onControllerNotFound(): Response;
}