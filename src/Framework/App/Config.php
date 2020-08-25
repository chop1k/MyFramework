<?php


namespace Framework\App;


class Config
{
    public function __construct()
    {
        $this->array = [];
    }

    private array $array;

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->array);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->array[$key]);
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key)
    {
        return $this->array[$key];
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value)
    {
        $this->array[$key] = $value;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->array;
    }

    /**
     * @param array $array
     * @return void
     */
    public function replace(array $array): void
    {
        foreach ($array as $key => $value)
        {
            $this->array[$key] = $value;
        }
    }

}