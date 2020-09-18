<?php


namespace Framework\Controller;


use Framework\Data\HandlerKit;
use Framework\Exceptions\InvalidControllerException;

/**
 * Class Controller which represents structure of controller.
 * @package Framework\Controller
 */
class Controller
{
    /**
     * Contains controller name.
     * @var string $name
     */
    private string $name;

    /**
     * Returns controller name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets controller name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains controller class.
     * @var string $class
     */
    private string $class;

    /**
     * Returns controller class.
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Sets controller class.
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * Contains controller method.
     * @var string $method
     */
    private string $method;

    /**
     * Returns controller method.
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Sets controller method.
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * Contains array of before-middleware
     * @var array $beforeMiddleware
     */
    private array $beforeMiddleware;

    /**
     * Returns array of before-middleware.
     * @return array
     */
    public function getBeforeMiddleware(): array
    {
        return $this->beforeMiddleware;
    }

    /**
     * Adds middleware name to before-middleware array.
     * @param string $middleware
     */
    public function addBeforeMiddleware(string $middleware): void
    {
        $this->beforeMiddleware[] = $middleware;
    }

    /**
     * Contains array of after-middleware.
     * @var array $afterMiddleware
     */
    private array $afterMiddleware;

    /**
     * Returns array of after-middleware.
     * @return array
     */
    public function getAfterMiddleware(): array
    {
        return $this->afterMiddleware;
    }

    /**
     * Adds controller name to after-middleware array.
     * @param string $middleware
     */
    public function addAfterMiddleware(string $middleware): void
    {
        $this->afterMiddleware[] = $middleware;
    }

    /**
     * Indicates when middleware will ignore exceptions.
     * @var bool $exceptions
     */
    private bool $exceptions;

    /**
     * Indicates when middleware will ignore exceptions.
     * @return bool
     */
    public function isExceptions(): bool
    {
        return $this->exceptions;
    }

    /**
     * Sets exceptions ignore.
     * @param bool $exceptions
     */
    public function setExceptions(bool $exceptions): void
    {
        $this->exceptions = $exceptions;
    }

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->beforeMiddleware = [];
        $this->afterMiddleware = [];
        $this->setExceptions(false);
    }

    /**
     * Returns instance of controller.
     * @param HandlerKit $handlerKit
     * @return object
     * @throws InvalidControllerException
     */
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
        $instance->query = $handlerKit->query;
        $instance->manager = $handlerKit->manager;
        $instance->memcache = $handlerKit->memcache;

        return $instance;
    }

    /**
     * Shortcut for create controller by array from config.
     * @param string $name
     * @param array $array
     * @return Controller
     */
    public static function fromArray(string $name, array $array): Controller
    {
        $controller = new Controller();

        $controller->setName($name);
        $controller->setClass($array['class']);
        $controller->setMethod($array['method']);

        if (isset($array['middleware']))
        {
            foreach ($array['middleware']['before'] as $name)
            {
                $controller->addBeforeMiddleware($name);
            }

            foreach ($array['middleware']['after'] as $name)
            {
                $controller->addAfterMiddleware($name);
            }

            $controller->setExceptions($array['middleware']['exceptions']);
        }

        return $controller;
    }
}