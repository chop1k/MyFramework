<?php


namespace App\Subscribers;


use Framework\Http\Response;
use Framework\Subscriber\AbstractSubscriber;
use Framework\Subscriber\ExceptionInterface;

/**
 * this class here only for testing
 */
class ExceptionSubscriber extends AbstractSubscriber implements ExceptionInterface
{
    public function onException(): Response
    {
        return new Response($this->exception->getMessage(), 500);
    }
}