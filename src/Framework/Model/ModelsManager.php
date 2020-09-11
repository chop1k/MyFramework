<?php


namespace Framework\Model;

use Framework\Model\MySQL\MySQLProvider;

/**
 * Class ModelsManager
 * @package Framework\Model
 */
class ModelsManager
{
    public function __construct()
    {
        $this->providers = [];
    }

    /**
     * @var array $providers
     */
    private array $providers;

    /**
     * @return array
     */
    public function getProviders(): array
    {
        return $this->providers;
    }

    public function addProvider(string $name, DatabaseProvider $provider): void
    {
        $this->providers[$name] = $provider;
    }

    /**
     * Returns database provider which defined in config.
     * @param string $name
     * @return DatabaseProvider
     */
    public function getProvider(string $name): DatabaseProvider
    {
        return $this->providers[$name];
    }

    public static function create(array $providers): ModelsManager
    {
        $manager = new ModelsManager();

        foreach ($providers as $name => $value)
        {
            $provider = null;

            switch ($value['provider'])
            {
                case DatabaseProvider::MySQL:
                    $provider = new MySQLProvider(); break;
                default:
                    continue 2;
            }

            $provider->setHost($value['host']);
            $provider->setUser($value['user']);
            $provider->setPassword($value['password']);
            $provider->setName($value['name']);
            $provider->setPort($value['port']);

            $manager->addProvider($name, $provider);
        }

        return $manager;
    }
}