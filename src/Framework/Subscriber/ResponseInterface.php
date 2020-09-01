<?php


namespace Framework\Subscriber;

/**
 * Interface ResponseInterface for Response event subscriber.
 * @package Framework\Subscriber
 */
interface ResponseInterface
{
    /**
     * Executes when Response event invokes.
     */
    public function onResponse(): void;
}