<?php

use App\Subscribers\ExceptionSubscriber;
use App\Subscribers\RequestSubscriber;
use App\Subscribers\ResponseSubscriber;
use Framework\Subscriber\Event;

/**
 * there subscribers need only for testing
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