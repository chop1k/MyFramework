<?php

return [
    'route_name' => [
        'path' => '/test/path/:name',
        'controller' => 'controller_name',
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