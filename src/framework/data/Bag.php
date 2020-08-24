<?php

namespace framework\data;

interface Bag
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
     * @return string
     */
    public function get(string $key): string;

    /**
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value);

    /**
     * @return array
     */
    public function all(): array;

    public function replace(array $array);
}