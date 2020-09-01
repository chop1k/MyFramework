<?php


namespace Framework\Http;


use Framework\Data\Bag;
use Framework\Data\CookieBag;
use Framework\Data\Cookies;
use Framework\Data\FileBag;
use Framework\Data\Files;
use Framework\Data\HeaderBag;
use Framework\Data\Headers;
use Framework\Data\Params;
use Framework\Data\Query;
use Framework\Data\Url;

/**
 * Class Request represents request.
 * @package Framework\Http
 */
class Request
{
    /**
     * Contains request method.
     * @var string $method
     */
    private string $method;

    /**
     * Returns request method.
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Sets request method.
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * Contains request url.
     * @var Url $url
     */
    private Url $url;

    /**
     * Returns request url.
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * Sets request url.
     * @param Url $url
     */
    public function setUrl(Url $url): void
    {
        $this->url = $url;
    }

    /**
     * Contains request headers.
     * @var HeaderBag $headers
     */
    private HeaderBag $headers;

    /**
     * Returns request headers.
     * @return HeaderBag
     */
    public function getHeaders(): HeaderBag
    {
        return $this->headers;
    }

    /**
     * Sets request headers.
     * @param HeaderBag $headers
     */
    public function setHeaders(HeaderBag $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * Contains request cookies.
     * @var CookieBag $cookies
     */
    private CookieBag $cookies;

    /**
     * Returns request cookies.
     * @return CookieBag
     */
    public function getCookies(): CookieBag
    {
        return $this->cookies;
    }

    /**
     * Sets request cookies.
     * @param CookieBag $cookies
     */
    public function setCookies(CookieBag $cookies): void
    {
        $this->cookies = $cookies;
    }

    /**
     * Contains request query.
     * @var Bag $query
     */
    private Bag $query;

    /**
     * Returns request query.
     * @return Bag
     */
    public function getQuery(): Bag
    {
        return $this->query;
    }

    /**
     * Sets request query.
     * @param Bag $query
     */
    public function setQuery(Bag $query): void
    {
        $this->query = $query;
    }

    /**
     * Contains request body data.
     * @var Bag $request
     */
    private Bag $request;

    /**
     * Returns request body data.
     * @return Bag
     */
    public function getRequest(): Bag
    {
        return $this->request;
    }

    /**
     * Sets request body data.
     * @param Bag $request
     */
    public function setRequest(Bag $request): void
    {
        $this->request = $request;
    }

    /**
     * Contains request files.
     * @var FileBag
     */
    private FileBag $files;

    /**
     * Returns request files.
     * @return FileBag
     */
    public function getFiles(): FileBag
    {
        return $this->files;
    }

    /**
     * Sets request files.
     * @param FileBag $files
     */
    public function setFiles(FileBag $files): void
    {
        $this->files = $files;
    }

    /**
     * Contains request params.
     * @var Bag $params
     */
    private Bag $params;

    /**
     * Return request params.
     * @return Bag
     */
    public function getParams(): Bag
    {
        return $this->params;
    }

    /**
     * Sets request params.
     * @param Bag $params
     */
    public function setParams(Bag $params): void
    {
        $this->params = $params;
    }

    /**
     * Contains time of request in unix.
     * @var int
     */
    private int $time;

    /**
     * Return time of request in unix.
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * Sets time of request in unix.
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    /**
     * Contains remote address.
     * @var string $addr
     */
    private string $addr;

    /**
     * Returns remote address.
     * @return string
     */
    public function getAddr(): string
    {
        return $this->addr;
    }

    /**
     * Sets remote address.
     * @param string $addr
     */
    public function setAddr(string $addr): void
    {
        $this->addr = $addr;
    }

    /**
     * Contains port.
     * @var int $port
     */
    private int $port;

    /**
     * Returns port.
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Sets port.
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * Shortcut for creating request from globals.
     * @return Request
     */
    public static function createFromGlobals(): Request
    {
        $request = new Request();

        $request->setUrl(new Url($_SERVER['REQUEST_URI']));
        $request->setMethod($_SERVER['REQUEST_METHOD']);
        $request->setTime($_SERVER['REQUEST_TIME']);

        $request->setAddr($_SERVER['REMOTE_ADDR']);
        $request->setPort($_SERVER['REMOTE_PORT']);

        $request->setQuery(Query::createFromGlobals());
        $request->setCookies(Cookies::createFromGlobals());
        $request->setHeaders(Headers::createFromGlobals());
        $request->setFiles(Files::createFromGlobals());

        $request->setParams(new Params());

        return $request;
    }
}