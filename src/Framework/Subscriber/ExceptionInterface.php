<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

interface ExceptionInterface
{
    public function onException(): Response;
}