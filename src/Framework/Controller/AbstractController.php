<?php


namespace Framework\Controller;


use Exception;
use Framework\App\Config;
use Framework\Headers;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Model\ModelsManager;

abstract class AbstractController
{
    /**
     * @var Config $config
     */
    protected Config $config;

    /**
     * @var Request $request
     */
    protected Request $request;

    public function json(array $json, int $status, array $headers = []): Response
    {
        $headers['content-type'] = 'application/json';

        return $this->response(json_encode($json), $status, $headers);
    }

    public function file(string $path, array $headers = []): Response
    {
        if (!is_file($path))
            throw new Exception('fff'); // TODO: need normal exception

        $file = fopen($path, 'r');

        if ($file === false)
            throw new Exception('gf'); // TODO: need normal exception

        $length = filesize($path);

        if ($length === false)
            throw new Exception('dddd'); // TODO: need normal exception

        $headers['content-type'] = mime_content_type($path);
        $headers['content-length'] = $length;

        try {
            return $this->response(stream_get_contents($file), 200, $headers);
        } finally {
            fclose($file);
        }
    }

    public function response($body, int $status, array $headers = []): Response
    {
        $response = new Response();

        $response->setStatus($status);
        $response->setHeaders(Headers::fromArray($headers));
        $response->setBody($body);

        return $response;
    }
}