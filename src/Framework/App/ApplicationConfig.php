<?php


namespace Framework\App;


class ApplicationConfig
{
    /**
     * @var string $rootPath
     */
    protected string $rootPath;

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
    protected string $controllersPath;

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

    protected string $modelsPath;

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

    protected string $subscribersPath;

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
    protected string $routesPath;

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
}