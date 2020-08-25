<?php


namespace framework\data;


use framework\Header;

interface HeaderBag
{
    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param string $name
     * @return Header
     */
    public function get(string $name): Header;

    /**
     * @param string $name
     * @param string $value
     */
    public function set(string $name, string $value): void;

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @return array
     */
    public function allNew(): array;
}