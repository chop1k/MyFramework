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
        $this->memcache->set('i', $this->memcache->get('i')+1);

        return new Response($this->memcache->get('i'), 200);
    }
}