<?php

use App\Controllers\TestController;

/**
 * That file returning list of controllers, provided in scheme below
 *
 * 'controller_name' => [
 *      'class' => CLass::class,
 *      'method' => 'methodName',
 *      'middleware' => [
 *          'before' => [
 *              'middleware_name'
 *          ],
 *          'after' => [
 *              'middleware_name'
 *          ],
 *          'exceptions' => true|false
 *      ]
 * ]
 *
 * controller_name represents controller identifier and must be unique.
 * class represents a controller class, would be inherited by AbstractController.
 * method represents a method of controller-class which will be executed.
 * middleware represents object with only 2 keys: before and after.
 * before executes before controller, after executes after controller appropriate.
 * middleware_name must be a name of middleware defined in middleware config list, by default its .../config/middleware.php.
 * exceptions represents a bool, which denotes ignore exceptions or not.
 * For example, if exceptions is false and after-middleware count => 0
 * then application will ignore exception in controller and will continue after-middleware.
 *
 * Middleware is array, so it will be executed synchronously.
 */
return [
    'test_controller' => [
        'class' => TestController::class,
        'method' => 'index'
    ]
];