<?php


namespace Framework\Subscriber;


interface ResponseInterface
{
    public function onResponse(): void;
}