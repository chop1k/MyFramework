<?php


namespace Framework\Data;


use Framework\Header;

class Headers implements HeaderBag
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
        return isset($this->array[strtoupper($key)]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): Header
    {
        return $this->array[strtoupper($key)];
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, string $value, bool $new = true): void
    {
        $header = new Header();

        $header->setName(strtoupper($key));
        $header->setValue($value);
        $header->setNew($new);

        $this->array[$header->getName()] = $header;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->array;
    }

    public function allNew(): array
    {
        $array = [];

        /**
         * @var Header $value
         */
        foreach ($this->array as $value)
        {
            if ($value->isNew())
                $array[] = $value;
        }

        return $array;
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

            $headers->set($key, $value, false);
        }

        return $headers;
    }
}