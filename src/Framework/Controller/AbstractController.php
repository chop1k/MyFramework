<?php


namespace Framework\Controller;


use Framework\App\Config;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Model\ModelsManager;

abstract class AbstractController
{
    /**
     * @var Request $request
     */
    protected Request $request;
}