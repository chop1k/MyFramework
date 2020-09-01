<?php


namespace Framework\Data;


use Framework\Header;

/**
 * Class Headers represents implementation of header bag.
 * @package Framework\Data
 */
class Headers implements HeaderBag
{
    /**
     * Headers constructor.
     */
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
    public function has(string $key, bool $strict = false): bool
    {
        if ($strict)
            return isset($this->array[$key]);
        else
            return isset($this->array[strtoupper($key)]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key, bool $strict = false): Header
    {
        if (!$strict)
            return $this->array[strtoupper($key)];

        return $this->array[$key];
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, string $value, bool $strict = false): void
    {
        $header = new Header();

        if ($strict)
            $header->setName($key);
        else
            $header->setName(strtoupper($key));

        $header->setValue($value);

        $this->array[$header->getName()] = $header;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->array;
    }

    /**
     * Shortcut for creating headers from globals.
     * @return Headers
     */
    public static function createFromGlobals(): Headers
    {
        $headers = new Headers();

        foreach ($_SERVER as $key => $value)
        {
            if (substr($key, 0 , 5) !== 'HTTP_')
                continue;

            $key = substr($key, 5, strlen($key));

            $headers->set($key, $value, false);
        }

        return $headers;
    }

    /**
     * Shortcut for creating headers from array.
     * @param array $array
     * @return Headers
     */
    public static function fromArray(array $array): Headers
    {
        $headers = new Headers();

        foreach ($array as $key => $value)
        {
            $headers->set($key, $value);
        }

        return $headers;
    }
}