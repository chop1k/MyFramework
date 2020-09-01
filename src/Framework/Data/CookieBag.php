<?php


namespace Framework\Data;

use Framework\Cookie;

/**
 * Interface CookieBag represents bag for cookie.
 * @package Framework\Data
 */
interface CookieBag
{
    /**
     * Returns number of cookies.
     * @return int
     */
    public function count(): int;

    /**
     * Checks if bag contains cookie with given name.
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Returns cookie by given name.
     * @param string $key
     * @return Cookie
     */
    public function get(string $key): Cookie;

    /**
     * Sets cookie.
     * @param Cookie $file
     * @return mixed
     */
    public function set(Cookie $file);

    /**
     * Returns array with all cookies.
     * @return array
     */
    public function all(): array;
}