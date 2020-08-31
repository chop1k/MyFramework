<?php


namespace Framework\App;


class ApplicationConfig
{
    /**
     * @var string $rootPath
     */
    private string $rootPath;

    /**
     * @return string
     */
    public function getRootPath(): string
    {
        return $this->rootPath;
    }

    /**
     * @param string $rootPath
     */
    public function setRootPath(string $rootPath): void
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @var string $controllersPath
     */
    private string $controllersPath;

    /**
     * @return string
     */
    public function getControllersPath(): string
    {
        return $this->controllersPath;
    }

    /**
     * @param string $controllersPath
     */
    public function setControllersPath(string $controllersPath): void
    {
        $this->controllersPath = $controllersPath;
    }

    private string $modelsPath;

    /**
     * @return string
     */
    public function getModelsPath(): string
    {
        return $this->modelsPath;
    }

    /**
     * @param string $modelsPath
     */
    public function setModelsPath(string $modelsPath): void
    {
        $this->modelsPath = $modelsPath;
    }

    private string $subscribersPath;

    /**
     * @return string
     */
    public function getSubscribersPath(): string
    {
        return $this->subscribersPath;
    }

    /**
     * @param string $subscribersPath
     */
    public function setSubscribersPath(string $subscribersPath): void
    {
        $this->subscribersPath = $subscribersPath;
    }

    /**
     * @var string $routesPath
     */
    private string $routesPath;

    /**
     * @return string
     */
    public function getRoutesPath(): string
    {
        return $this->routesPath;
    }

    /**
     * @param string $routesPath
     */
    public function setRoutesPath(string $routesPath): void
    {
        $this->routesPath = $routesPath;
    }

    /**
     * @var string $frameworkPath
     */
    private string $frameworkPath;

    /**
     * @return string
     */
    public function getFrameworkPath(): string
    {
        return $this->frameworkPath;
    }

    /**
     * @param string $frameworkPath
     */
    public function setFrameworkPath(string $frameworkPath): void
    {
        $this->frameworkPath = $frameworkPath;
    }

    /**
     * @var string $middlewarePath
     */
    private string $middlewarePath;

    /**
     * @return string
     */
    public function getMiddlewarePath(): string
    {
        return $this->middlewarePath;
    }

    /**
     * @param string $middlewarePath
     */
    public function setMiddlewarePath(string $middlewarePath): void
    {
        $this->middlewarePath = $middlewarePath;
    }
}