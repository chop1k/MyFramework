<?php


namespace App\Subscribers;


use Framework\Subscriber\AbstractSubscriber;
use Framework\Subscriber\ResponseInterface;

/**
 * this class here only for testing
 */
class ResponseSubscriber extends AbstractSubscriber implements ResponseInterface
{
    public function onResponse(): void
    {
    }
}