<?php


namespace Framework\App;

/**
 * Class Config represents config with any values.
 * @package Framework\App
 */
class Config
{
    public function __construct()
    {
        $this->array = [];
    }

    /**
     * Contains config data.
     * @var array $array
     */
    private array $array;

    /**
     * Returns number of pairs key-value which are contained in the config.
     * @return int
     */
    public function count(): int
    {
        return count($this->array);
    }

    /**
     * Checks if config contains key.
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->array[$key]);
    }

    /**
     * Gets value from config.
     * @param string $key
     * @return string
     */
    public function get(string $key)
    {
        return $this->array[$key];
    }

    /**
     * Sets value to config.
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value)
    {
        $this->array[$key] = $value;
    }

    /**
     * Returns raw config.
     * @return array
     */
    public function all(): array
    {
        return $this->array;
    }

    /**
     * Replaces values in given array.
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

    /**
     * Shortcut.
     * @param array $array
     * @return Config
     */
    public static function fromArray(array $array): Config
    {
        $config = new Config();

        $config->replace($array);

        return $config;
    }
}