<?php


namespace Framework\Http;


use Framework\Data\HeaderBag;
use Framework\Data\Headers;
use Framework\Header;

class Response
{
    public function __construct($body, int $status, array $headers = [])
    {
        $this->setBody($body);
        $this->setStatus($status);
        $this->setHeaders(Headers::fromArray($headers));
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
        http_response_code($this->getStatus());

        /**
         * @var Header $header
         */
        foreach ($this->getHeaders()->all() as $header)
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
                return self::getNotFound(null);
            case 405:
                return self::getMethodNotAllowed(null);
            default:
                return self::getInternalServerError(null);
        }
    }

    public static function getInternalServerError($body, array $headers = []): Response
    {
        return new Response($body, 500, $headers);
    }

    public static function getMethodNotAllowed($body, array $headers = []): Response
    {
        return new Response($body, 405, $headers);
    }

    public static function getNotFound($body, array $headers = []): Response
    {
        return new Response($body, 404, $headers);
    }

    public static function getForbidden($body, array $headers = []): Response
    {
        return new Response($body, 403, $headers);
    }

    public static function getBagRequest($body, array $headers = []): Response
    {
        return new Response($body, 400, $headers);
    }
}