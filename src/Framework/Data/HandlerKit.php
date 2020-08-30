<?php


namespace Framework\Data;


use Framework\App\Config;
use Framework\Http\Request;

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
}