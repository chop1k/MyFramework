<?php


namespace Framework\Data;


use Framework\Cookie;

class Cookies implements CookieBag
{
    public function __construct()
    {
        $this->cookies = [];
    }

    /**
     * @var array $cookies
     */
    private array $cookies;

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->cookies);
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return isset($this->cookies[$key]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): Cookie
    {
        return $this->cookies[$key];
    }

    /**
     * @inheritDoc
     */
    public function set(Cookie $cookie)
    {
        $this->cookies[$cookie->getName()] = $cookie;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->cookies;
    }

    public static function createFromGlobals(): Cookies
    {
        $cookies = new Cookies();

        foreach ($_COOKIE as $key => $value)
        {
            $cookie = new Cookie();

            $cookie->setName($key);
            $cookie->setValue($value);

            $cookies->set($cookie);
        }

        return $cookies;
    }
}