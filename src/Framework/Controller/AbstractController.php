<?php


namespace Framework\Controller;


use Framework\App\Config;
use Framework\Model\ModelsManager;

abstract class AbstractController
{
    /**
     * @var Config $config
     */
    private Config $config;

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

}