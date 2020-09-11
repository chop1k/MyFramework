<?php


namespace Framework\Model;

use Framework\Data\Bag;

/**
 * Class QueryProvider represents class for access to queries, which defined in config.
 * @package Framework\Model
 */
class QueryProvider implements Bag
{
    public function __construct()
    {
        $this->array = [];
    }

    /**
     * Shortcut for creating query provider from config.
     * @param array $queries
     * @return QueryProvider
     */
    public static function fromConfig(array $queries): QueryProvider
    {
        $provider = new QueryProvider();

        $provider->replace($queries);

        return $provider;
    }

    /**
     * Contains all queries which defined in config.
     * @var array $array
     */
    private array $array;

    /**
     * Returns number of queries.
     * @return int
     */
    public function count(): int
    {
        return count($this->array);
    }

    /**
     * Returns true if query exists.
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->array[$key]);
    }

    /**
     * Sets query.
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value)
    {
        $this->array[$key] = $value;
    }

    /**
     * Returns all queries.
     * @return array
     */
    public function all(): array
    {
        return $this->array;
    }

    /**
     * Replaces values from given array to bag.
     * @param array $array
     * @return mixed|void
     */
    public function replace(array $array)
    {
        foreach ($array as $key => $value)
        {
            $this->set($key, $value);
        }
    }

    /**
     * Returns query with given name.
     * @param string $key
     * @return mixed|string
     */
    public function get(string $key)
    {
        return $this->array[$key];
    }
}