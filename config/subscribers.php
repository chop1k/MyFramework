<?php

use App\Subscribers\ExceptionSubscriber;
use App\Subscribers\RequestSubscriber;
use App\Subscribers\ResponseSubscriber;
use Framework\Subscriber\Event;

/**
 * That file returning subscribers, provided in scheme below.
 *
 * 'subscriber_name' => [
 *      'event' => Event::Event,
 *      'class' => Class::class
 * ]
 *
 * subscriber_name represents subscriber unique identifier.
 * event represents a event number, Event numbers are arranged as constants in Event class.
 * class represents a subscriber class, must be inherited by AbstractSubscriber.
 *
 * Some events support multiple subscribers. They executes synchronously until a response is returned.
 */
return [
    'request_subscriber' => [
        'event' => Event::Request,
        'class' => RequestSubscriber::class,
    ],
    'exception_subscriber' => [
        'event' => Event::Exception,
        'class' => ExceptionSubscriber::class
    ],
    'response_subscriber' => [
        'event' => Event::Response,
        'class' => ResponseSubscriber::class
    ]
];