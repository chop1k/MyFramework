<?php


namespace Framework\App;

use Framework\Data\Bag;
use Framework\Http\Request;

class Application
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
     * @var Bag $config
     */
    protected Bag $config;

    /**
     * @return Bag
     */
    public function getConfig(): Bag
    {
        return $this->config;
    }

    /**
     * @param Bag $config
     */
    public function setConfig(Bag $config): void
    {
        $this->config = $config;
    }

    public function handle()
    {
        $request = Request::createFromGlobals();


    }
}