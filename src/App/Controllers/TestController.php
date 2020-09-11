<?php


namespace App\Controllers;


use Framework\Controller\AbstractController;
use Framework\Http\Response;

/**
 * this class here only for testing
 */
class TestController extends AbstractController
{
    public function index(): Response
    {
        return new Response('ok', 200);
    }
}