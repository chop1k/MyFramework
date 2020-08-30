<?php


namespace App\Controllers;


use Framework\Controller\AbstractController;
use Framework\Data\Headers;
use Framework\Http\Response;

class TestController extends AbstractController
{
    public function index(): Response
    {
        $response = new Response();

        $response->setBody('ok');
        $response->setHeaders(new Headers());
        $response->setStatus(200);

        return $response;
    }
}