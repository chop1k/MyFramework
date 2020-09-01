<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

/**
 * Interface ExceptionInterface for Exception event subscriber.
 * @package Framework\Subscriber
 */
interface ExceptionInterface
{
    /**
     * Executes when Exception event invokes.
     * @return Response
     */
    public function onException(): Response;
}