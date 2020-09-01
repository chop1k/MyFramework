<?php

use App\Middleware\AfterMiddleware;
use App\Middleware\BeforeMiddleware;

/**
 * That file contains list of middleware, provided in scheme below
 *
 * 'middleware_name' => [
 *      'class' => Class::class,
 *      'method' => 'methodName'
 * ]
 *
 * middleware_name represents a middleware identifier and must be unique.
 * class represents a middleware class, must be inherited by AbstractMiddleware.
 * method represents a method, which will be executed.
 *
 * Middleware can return instance of Response or bool.
 * If middleware returns Response then application will stop executing middleware and will return Response;
 * If middleware returns true then it will stop executing middleware and continue executing controller.
 * If false then it will continue executing middleware.
 * If middleware returns another type then application throws exception.
 */
return [
    'before' => [
        'class' => BeforeMiddleware::class,
        'method' => 'test'
    ],
    'after' => [
        'class' => AfterMiddleware::class,
        'method' => 'test'
    ]
];