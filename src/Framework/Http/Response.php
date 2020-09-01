<?php


namespace Framework\Http;


use Framework\Data\HeaderBag;
use Framework\Data\Headers;
use Framework\Header;

/**
 * Class Response represents response to request.
 * @package Framework\Http
 */
class Response
{
    /**
     * Response constructor.
     * @param $body
     * @param int $status
     * @param array $headers
     */
    public function __construct($body, int $status, array $headers = [])
    {
        $this->setBody($body);
        $this->setStatus($status);
        $this->setHeaders(Headers::fromArray($headers));
    }

    /**
     * Contains response status.
     * @var int $status
     */
    private int $status;

    /**
     * Returns response status.
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Sets response status.
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * Contains response body.
     * @var mixed $body
     */
    private $body;

    /**
     * Returns response body.
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Sets response body.
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * Contains response headers.
     * @var HeaderBag $headers
     */
    private HeaderBag $headers;

    /**
     * Returns response headers.
     * @return HeaderBag
     */
    public function getHeaders(): HeaderBag
    {
        return $this->headers;
    }

    /**
     * Sets response headers.
     * @param HeaderBag $headers
     */
    public function setHeaders(HeaderBag $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * Sends status, body and headers.
     */
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

    /**
     * Returns default response related to status.
     * @param int $status
     * @return Response
     */
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

    /**
     * Shortcut to creating response with status 500.
     * @param $body
     * @param array $headers
     * @return Response
     */
    public static function getInternalServerError($body, array $headers = []): Response
    {
        return new Response($body, 500, $headers);
    }

    /**
     * Shortcut to creating response with status 405.
     * @param $body
     * @param array $headers
     * @return Response
     */
    public static function getMethodNotAllowed($body, array $headers = []): Response
    {
        return new Response($body, 405, $headers);
    }

    /**
     * Shortcut to creating response with status 404.
     * @param $body
     * @param array $headers
     * @return Response
     */
    public static function getNotFound($body, array $headers = []): Response
    {
        return new Response($body, 404, $headers);
    }

    /**
     * Shortcut to creating response with status 403.
     * @param $body
     * @param array $headers
     * @return Response
     */
    public static function getForbidden($body, array $headers = []): Response
    {
        return new Response($body, 403, $headers);
    }

    /**
     * Shortcut to creating response with status 400.
     * @param $body
     * @param array $headers
     * @return Response
     */
    public static function getBagRequest($body, array $headers = []): Response
    {
        return new Response($body, 400, $headers);
    }
}