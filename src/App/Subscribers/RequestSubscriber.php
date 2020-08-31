<?php


namespace App\Subscribers;


use Framework\Http\Response;
use Framework\Subscriber\AbstractSubscriber;
use Framework\Subscriber\RequestInterface;

/**
 * this class here only for testing
 */
class RequestSubscriber extends AbstractSubscriber implements RequestInterface
{

    public function onRequest(): ?Response
    {
        return null;
    }
}