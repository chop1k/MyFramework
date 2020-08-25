<?php

namespace Framework\Data;

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
    public function get(string $key);

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value);

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param array $array
     * @return mixed
     */
    public function replace(array $array);
}