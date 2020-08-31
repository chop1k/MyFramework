<?php

use App\Controllers\TestController;

return [
    'test_controller' => [
        'class' => TestController::class,
        'method' => 'index',
        'middleware' => [
            'before' => [
                'before'
            ],
            'after' => [
                'after'
            ]
        ]
    ]
];