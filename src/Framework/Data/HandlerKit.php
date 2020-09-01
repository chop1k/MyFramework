<?php


namespace Framework\Data;


use Framework\App\Config;
use Framework\Http\Request;
use Framework\Http\Response;

/**
 * Class HandlerKit represents kit of data to handling in special classes.
 * @package Framework\Data
 */
class HandlerKit
{
    /**
     * Contains config instance.
     * @var Config $config
     */
    public Config $config;

    /**
     * Contains request instance.
     * @var Request $request
     */
    public Request $request;

    /**
     * Contains response instance or null.
     * @var Response|null $response
     */
    public ?Response $response;
}