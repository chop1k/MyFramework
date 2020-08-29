<?php

return [
    'route_name' => [
        'path' => '/test/path/:name',
        'controller' => 'test_controller',
        'methods' => [
            'GET', 'POST'
        ],
        'tags' => [
            'name' => [
                'type' => 'integer',
                'nullable' => true,
                'step' => 3
            ]
        ]
    ]
];