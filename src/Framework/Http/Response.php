<?php


namespace Framework\Http;


use Framework\Data\HeaderBag;
use Framework\Data\Headers;
use Framework\Header;

class Response
{
    public function __construct()
    {
    }

    /**
     * @var int $status
     */
    private int $status;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @var mixed $body
     */
    private $body;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @var HeaderBag $headers
     */
    private HeaderBag $headers;

    /**
     * @return HeaderBag
     */
    public function getHeaders(): HeaderBag
    {
        return $this->headers;
    }

    /**
     * @param HeaderBag $headers
     */
    public function setHeaders(HeaderBag $headers): void
    {
        $this->headers = $headers;
    }

    public function send()
    {
        http_response_code($this->status);

        /**
         * @var Header $header
         */
        foreach ($this->headers->all() as $header)
        {
            header($header->getName().':'.$header->getValue());
        }

        echo $this->getBody();
    }

    public static function getFromStatus(int $status): Response
    {
        switch ($status)
        {
            case 404:
                return self::getNotFound();
            case 405:
                return self::getMethodNotAllowed();
            default:
                return self::getInternalServerError();
        }
    }

    public static function getInternalServerError(): Response
    {
        $response = new Response();

        $response->setStatus(500);
        $response->setHeaders(new Headers());

        return $response;
    }

    public static function getMethodNotAllowed(): Response
    {
        $response = new Response();

        $response->setStatus(405);
        $response->setHeaders(new Headers());

        return $response;
    }

    public static function getNotFound(): Response
    {
        $response = new Response();

        $response->setStatus(404);
        $response->setHeaders(new Headers());

        return $response;
    }
}