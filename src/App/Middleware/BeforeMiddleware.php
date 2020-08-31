<?php


namespace App\Middleware;


use Framework\Middleware\AbstractMiddleware;

/**
 * this class here only for testing
 */
class BeforeMiddleware extends AbstractMiddleware
{
    public function test()
    {
        echo 'before'.PHP_EOL;
    }
}