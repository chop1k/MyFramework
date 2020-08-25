<?php


namespace Framework\Data;


class Query implements Bag
{
    public function __construct()
    {
        $this->array = [];
    }

    /**
     * @var array $array
     */
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
    public function get(string $key): string
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

    /**
     * @return Query
     */
    public static function createFromGlobals(): Query
    {
        $query = new Query();

        foreach ($_GET as $key => $value)
        {
            $query->set($key, $value);
        }

        return $query;
    }
}