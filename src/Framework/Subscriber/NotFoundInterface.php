<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

/**
 * Interface NotFoundInterface for NotFound event subscriber.
 * @package Framework\Subscriber
 */
interface NotFoundInterface
{
    /**
     * Executes when NotFound event invokes.
     * @return Response
     */
    public function onNotFound(): Response;
}