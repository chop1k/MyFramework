<?php


namespace Framework\Data;


use Framework\Header;

/**
 * Interface HeaderBag
 * @package Framework\Data
 */
interface HeaderBag
{
    /**
     * Returns number of headers in bag.
     * @return int
     */
    public function count(): int;

    /**
     * Checks if bag contains header with given name.
     * @param string $name
     * @param bool $strict Converts to name upper case.
     * @return bool
     */
    public function has(string $name, bool $strict = false): bool;

    /**
     * Gets header with given name.
     * @param string $name
     * @param bool $strict Converts name to upper case.
     * @return Header
     */
    public function get(string $name, bool $strict = false): Header;

    /**
     * Sets header.
     * @param string $name
     * @param string $value
     * @param bool $strict Converts name to upper case.
     */
    public function set(string $name, string $value, bool $strict = false): void;

    /**
     * Returns array with all headers.
     * @return array
     */
    public function all(): array;
}