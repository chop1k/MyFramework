<?php


namespace Framework\Http;


use Framework\Data\Bag;
use Framework\Data\CookieBag;
use Framework\Data\Cookies;
use Framework\Data\FileBag;
use Framework\Data\Files;
use Framework\Data\HeaderBag;
use Framework\Data\Headers;
use Framework\Data\Query;

class Request
{
    /**
     * @var string $method
     */
    private string $method;

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @var string $url
     */
    private string $url;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
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

    /**
     * @var CookieBag $cookies
     */
    private CookieBag $cookies;

    /**
     * @return CookieBag
     */
    public function getCookies(): CookieBag
    {
        return $this->cookies;
    }

    /**
     * @param CookieBag $cookies
     */
    public function setCookies(CookieBag $cookies): void
    {
        $this->cookies = $cookies;
    }

    /**
     * @var Bag $query
     */
    private Bag $query;

    /**
     * @return Bag
     */
    public function getQuery(): Bag
    {
        return $this->query;
    }

    /**
     * @param Bag $query
     */
    public function setQuery(Bag $query): void
    {
        $this->query = $query;
    }

    /**
     * @var Bag $request
     */
    private Bag $request;

    /**
     * @return Bag
     */
    public function getRequest(): Bag
    {
        return $this->request;
    }

    /**
     * @param Bag $request
     */
    public function setRequest(Bag $request): void
    {
        $this->request = $request;
    }

    /**
     * @var FileBag
     */
    private FileBag $files;

    /**
     * @return FileBag
     */
    public function getFiles(): FileBag
    {
        return $this->files;
    }

    /**
     * @param FileBag $files
     */
    public function setFiles(FileBag $files): void
    {
        $this->files = $files;
    }

    /**
     * @var int
     */
    private int $time;

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    /**
     * @var string $addr
     */
    private string $addr;

    /**
     * @return string
     */
    public function getAddr(): string
    {
        return $this->addr;
    }

    /**
     * @param string $addr
     */
    public function setAddr(string $addr): void
    {
        $this->addr = $addr;
    }

    /**
     * @var int $port
     */
    private int $port;

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return Request
     */
    public static function createFromGlobals(): Request
    {
        $request = new Request();

        $request->setUrl($_SERVER['REQUEST_URI']);
        $request->setMethod($_SERVER['REQUEST_METHOD']);
        $request->setTime($_SERVER['REQUEST_TIME']);

        $request->setAddr($_SERVER['REMOTE_ADDR']);
        $request->setPort($_SERVER['REMOTE_PORT']);

        $request->setQuery(Query::createFromGlobals());
        $request->setCookies(Cookies::createFromGlobals());
        $request->setHeaders(Headers::createFromGlobals());
        $request->setFiles(Files::createFromGlobals());
    }
}