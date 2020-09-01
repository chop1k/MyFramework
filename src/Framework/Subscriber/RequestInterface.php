<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

/**
 * Interface RequestInterface for Request event subscribers.
 * @package Framework\Subscriber
 */
interface RequestInterface
{
    /**
     * Executes when Request event invokes.
     * @return Response|null
     */
    public function onRequest(): ?Response;
}