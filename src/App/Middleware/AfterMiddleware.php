<?php


namespace App\Middleware;


use Framework\Middleware\AbstractMiddleware;

/**
 * this class here only for testing
 */
class AfterMiddleware extends AbstractMiddleware
{
    public function test()
    {
        echo 'after'.PHP_EOL;
    }
}