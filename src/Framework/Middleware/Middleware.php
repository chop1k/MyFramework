<?php


namespace Framework\Middleware;


class Middleware
{
    /**
     * @var string $name
     */
    private string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @var string $class
     */
    private string $class;

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @var string $method
     */
    private string $method;

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getInstance(): object
    {
        $class = $this->getClass();

        return new $class();
    }

    public static function fromArray(string $name, array $array): Middleware
    {
        $middleware = new Middleware();

        $middleware->setName($name);
        $middleware->setClass($array['class']);
        $middleware->setMethod($array['method']);

        return $middleware;
    }
}