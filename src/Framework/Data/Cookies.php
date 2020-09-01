<?php


namespace Framework\Data;


use Framework\Cookie;

/**
 * Class Cookies represents implementation cookie bag.
 * @package Framework\Data
 */
class Cookies implements CookieBag
{
    /**
     * Cookies constructor.
     */
    public function __construct()
    {
        $this->cookies = [];
    }

    /**
     * Contains array of cookies.
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

    /**
     * Shortcut for creating cookie bag from globals.
     * @return Cookies
     */
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