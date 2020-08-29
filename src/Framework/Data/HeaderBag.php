<?php


namespace Framework\Data;


use Framework\Header;

interface HeaderBag
{
    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param string $name
     * @param bool $strict
     * @return bool
     */
    public function has(string $name, bool $strict = false): bool;

    /**
     * @param string $name
     * @param bool $strict
     * @return Header
     */
    public function get(string $name, bool $strict = false): Header;

    /**
     * @param string $name
     * @param string $value
     * @param bool $strict
     */
    public function set(string $name, string $value, bool $strict = false): void;

    /**
     * @return array
     */
    public function all(): array;
}