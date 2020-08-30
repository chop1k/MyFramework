<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

interface RequestInterface
{
    public function onRequest(): ?Response;
}