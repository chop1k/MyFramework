<?php


namespace Framework\Data;


use Framework\App\Config;
use Framework\Http\Request;
use Framework\Http\Response;

class HandlerKit
{
    /**
     * @var Config $config
     */
    public Config $config;

    /**
     * @var Request $request
     */
    public Request $request;

    /**
     * @var Response|null $response
     */
    public ?Response $response;
}