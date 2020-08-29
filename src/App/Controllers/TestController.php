<?php


namespace App\Controllers;


use Framework\Controller\AbstractController;
use Framework\Http\Response;

class TestController extends AbstractController
{
    public function index(): Response
    {
        return $this->response(var_dump($this->config), 200);
    }
}