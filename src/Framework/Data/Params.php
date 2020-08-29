<?php


namespace Framework\Data;


class Params implements Bag
{
    public function __construct()
    {
        $this->array = [];
    }

    private array $array;

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->array);
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return isset($this->array[$key]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        return $this->array[$key];
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $value)
    {
        $this->array[$key] = $value;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->array;
    }

    /**
     * @inheritDoc
     */
    public function replace(array $array)
    {
        foreach ($array as $key => $value)
        {
            $this->array[$key] = $value;
        }
    }
}