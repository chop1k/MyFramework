<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

/**
 * Interface MethodNotAllowedInterface for MethodNotAllowed event subscriber.
 * @package Framework\Subscriber
 */
interface MethodNotAllowedInterface
{
    /**
     * Executes when MethodNotAllowed event invokes.
     * @return Response
     */
    public function onMethodNotAllowed(): Response;
}