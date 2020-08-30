<?php


namespace Framework\Controller;


use Exception;
use Framework\Data\HandlerKit;

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

    public function getInstance(HandlerKit $handlerKit): object
    {
        $class = $this->getClass();

        /**
         * @var HandlerKit $instance
         */
        $instance = new $class();

        if (!($instance instanceof HandlerKit))
            throw new Exception('ffffvfv');

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

        return $controller;
    }
}