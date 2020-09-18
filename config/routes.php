<?php

/**
 * That file returning list of routes, provided in scheme below.
 *
 * 'route_name' => [
 *      'path' => '/path/to',
 *      'controller' => 'controller_identifier',
 *      'methods' => [
 *          'METHOD NAME IN UPPERCASE'
 *      ],
 *      'tags' => [
 *          'tag_name' => [
 *              'type' => 'value_type',
 *              'nullable' => true|false,
 *              'step' => step_number
 *          ]
 *      ]
 * ]
 *
 * route_name represents route identifier and must be unique.
 * path represents route path. Can contain tag name, provided by : before name.
 * controller represents controller unique identifier, which provided in controllers config.
 * methods represents array of available methods.
 * tags represents array of tags, defined in the corresponding scheme.
 *
 * Tag represents value in path, which indicates by tag name and : before him.
 *
 * tag_name represents tag unique identifier, indicates in path with : before name.
 * type represents value type, now supported types = integer and string.
 * nullable indicates whether value can be null.
 * step represents part of path where tag name situated.
 *
 * For example, /path/to/:tag_name step is 3, /path/:name is 2 respectively.
 */
return [
];