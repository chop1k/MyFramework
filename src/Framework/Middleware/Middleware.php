<?php


namespace Framework\Middleware;

/**
 * Class Middleware represents middleware.
 * @package Framework\Middleware
 */
class Middleware
{
    /**
     * Contains name of middleware.
     * @var string $name
     */
    private string $name;

    /**
     * Returns name of middleware.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name of middleware.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains class of middleware.
     * @var string $class
     */
    private string $class;

    /**
     * Returns class of middleware.
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Sets class of middleware.
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * Contains method of middleware.
     * @var string $method
     */
    private string $method;

    /**
     * Returns method of middleware.
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Sets method of middleware.
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * Gets instance of middleware.
     * @return object
     */
    public function getInstance(): object
    {
        $class = $this->getClass();

        return new $class();
    }

    /**
     * Shortcut for creating middleware by array from config.
     * @param string $name
     * @param array $array
     * @return Middleware
     */
    public static function fromArray(string $name, array $array): Middleware
    {
        $middleware = new Middleware();

        $middleware->setName($name);
        $middleware->setClass($array['class']);
        $middleware->setMethod($array['method']);

        return $middleware;
    }
}