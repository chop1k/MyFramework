<?php


namespace framework\data;


class Headers implements Bag
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
        return isset($this->array[strtoupper($key)]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): string
    {
        return $this->array[strtoupper($key)];
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, string $value)
    {
        $this->array[strtoupper($key)] = $value;
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
            $this->array[strtoupper($key)] = $value;
        }
    }

    /**
     * @return Headers
     */
    public static function createFromGlobals(): Headers
    {
        $headers = new Headers();

        foreach ($_SERVER as $key => $value)
        {
            if (substr($key, 0 , 5) !== 'HTTP_')
                continue;

            $key = substr($key, 0, strlen($key));

            $headers->set($key, $value);
        }

        return $headers;
    }
}