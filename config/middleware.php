<?php

use App\Middleware\AfterMiddleware;
use App\Middleware\BeforeMiddleware;

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