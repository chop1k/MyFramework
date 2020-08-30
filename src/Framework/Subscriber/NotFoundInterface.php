<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

interface NotFoundInterface
{
    public function onNotFound(): Response;
}