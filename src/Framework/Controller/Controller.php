<?php


namespace Framework\Controller;


use Framework\Data\HandlerKit;
use Framework\Exceptions\InvalidControllerException;

class Controller
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

    /**
     * @var array $beforeMiddleware
     */
    private array $beforeMiddleware;

    /**
     * @return array
     */
    public function getBeforeMiddleware(): array
    {
        return $this->beforeMiddleware;
    }

    /**
     * @param string $middleware
     */
    public function addBeforeMiddleware(string $middleware): void
    {
        $this->beforeMiddleware[] = $middleware;
    }

    /**
     * @var array $afterMiddleware
     */
    private array $afterMiddleware;

    /**
     * @return array
     */
    public function getAfterMiddleware(): array
    {
        return $this->afterMiddleware;
    }

    /**
     * @param string $middleware
     */
    public function addAfterMiddleware(string $middleware): void
    {
        $this->afterMiddleware[] = $middleware;
    }

    public function __construct()
    {
        $this->beforeMiddleware = [];
        $this->afterMiddleware = [];
    }

    public function getInstance(HandlerKit $handlerKit): object
    {
        $class = $this->getClass();

        /**
         * @var HandlerKit $instance
         */
        $instance = new $class();

        if (!($instance instanceof HandlerKit))
            throw new InvalidControllerException('invalid controller instance, instance must extends by '.HandlerKit::class);

        $instance->request = $handlerKit->request;
        $instance->config = $handlerKit->config;

        return $instance;
    }

    public static function fromArray(string $name, array $array): Controller
    {
        $controller = new Controller();

        $controller->setName($name);
        $controller->setClass($array['class']);
        $controller->setMethod($array['method']);

        foreach ($array['middleware']['before'] as $name)
        {
            $controller->addBeforeMiddleware($name);
        }

        foreach ($array['middleware']['after'] as $name)
        {
            $controller->addAfterMiddleware($name);
        }

        return $controller;
    }
}