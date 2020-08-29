<?php


namespace Framework\Data;



use Framework\Cookie;

interface CookieBag
{
    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @return Cookie
     */
    public function get(string $key): Cookie;

    /**
     * @param Cookie $file
     * @return mixed
     */
    public function set(Cookie $file);

    /**
     * @return array
     */
    public function all(): array;
}