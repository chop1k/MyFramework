<?php

namespace Framework\Data;

/**
 * Interface Bag represents bag, which contains any data.
 * @package Framework\Data
 */
interface Bag
{
    /**
     * Returns number of elements.
     * @return int
     */
    public function count(): int;

    /**
     * Checks if bag contain value with given key.
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Returns value by given key.
     * @param string $key
     * @return string
     */
    public function get(string $key);

    /**
     * Sets value with given key.
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value);

    /**
     * Returns raw bag.
     * @return array
     */
    public function all(): array;

    /**
     * Replaces values from given array to bag.
     * @param array $array
     * @return mixed
     */
    public function replace(array $array);
}