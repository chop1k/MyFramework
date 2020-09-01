<?php


namespace Framework\App;

/**
 * Class ApplicationConfig, contains paths to application config files
 * @package Framework\App
 */
class ApplicationConfig
{
    /**
     * Contains path to controllers config file
     * @var string $controllersPath
     */
    private string $controllersPath;

    /**
     * Gets path to controllers file config
     * @return string
     */
    public function getControllersPath(): string
    {
        return $this->controllersPath;
    }

    /**
     * Sets path to controllers config
     * @param string $controllersPath
     */
    public function setControllersPath(string $controllersPath): void
    {
        $this->controllersPath = $controllersPath;
    }

    /**
     * Contains path to models config file
     * @var string $modelsPath
     */
    private string $modelsPath;

    /**
     * Gets path to models config
     * @return string
     */
    public function getModelsPath(): string
    {
        return $this->modelsPath;
    }

    /**
     * Sets path to models config
     * @param string $modelsPath
     */
    public function setModelsPath(string $modelsPath): void
    {
        $this->modelsPath = $modelsPath;
    }

    /**
     * Contains path to subscribers config file
     * @var string $subscribersPath
     */
    private string $subscribersPath;

    /**
     * Gets path to subscribers config file
     * @return string
     */
    public function getSubscribersPath(): string
    {
        return $this->subscribersPath;
    }

    /**
     * Sets path to subscribers config file
     * @param string $subscribersPath
     */
    public function setSubscribersPath(string $subscribersPath): void
    {
        $this->subscribersPath = $subscribersPath;
    }

    /**
     * Contains path to routes config file
     * @var string $routesPath
     */
    private string $routesPath;

    /**
     * Gets path to routes config file
     * @return string
     */
    public function getRoutesPath(): string
    {
        return $this->routesPath;
    }

    /**
     * Sets path to routes config file
     * @param string $routesPath
     */
    public function setRoutesPath(string $routesPath): void
    {
        $this->routesPath = $routesPath;
    }

    /**
     * Contains path to framework config file
     * @var string $frameworkPath
     */
    private string $frameworkPath;

    /**
     * Gets path to framework config file
     * @return string
     */
    public function getFrameworkPath(): string
    {
        return $this->frameworkPath;
    }

    /**
     * Sets path to framework config file
     * @param string $frameworkPath
     */
    public function setFrameworkPath(string $frameworkPath): void
    {
        $this->frameworkPath = $frameworkPath;
    }

    /**
     * Contains path to middleware config file
     * @var string $middlewarePath
     */
    private string $middlewarePath;

    /**
     * Gets path to middleware config file
     * @return string
     */
    public function getMiddlewarePath(): string
    {
        return $this->middlewarePath;
    }

    /**
     * Sets path to middleware config file
     * @param string $middlewarePath
     */
    public function setMiddlewarePath(string $middlewarePath): void
    {
        $this->middlewarePath = $middlewarePath;
    }
}