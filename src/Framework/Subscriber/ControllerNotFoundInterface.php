<?php


namespace Framework\Subscriber;


use Framework\Http\Response;

/**
 * Interface ControllerNotFoundInterface for ControllerNotFound event subscriber.
 * @package Framework\Subscriber
 */
interface ControllerNotFoundInterface
{
    /**
     * Executes when ControllerNotFound event invoke.
     * @return Response
     */
    public function onControllerNotFound(): Response;
}