<?php

return [
    'controller_identifier' => [
        'class' => 'ExampleController::class',
        'method' => 'exampleMethod',
        'middleware' => [
            'before' => [
                'middleware_identifier1',
                'middleware_identifier2'
            ],
            'after' => [
                'middleware_identifier1',
                'middleware_identifier2'
            ]
        ]
    ]
];