<?php


namespace App\Controllers;


use Exception;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

/**
 * this class here only for testing
 */
class TestController extends AbstractController
{
    public function index(): Response
    {
        throw new Exception('g');

        return new Response('null', 200);
    }
}