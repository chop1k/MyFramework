<?php

namespace Framework\Cache;

use Exception;
use Memcached;

/**
 * Class Cache represents cache config object.
 * @package Framework\Cache
 */
class Cache
{
    /**
     * Contains cache hostname.
     * @var string $host
     */
    private string $host;

    /**
     * Returns cache hostname.
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Sets cache hostname.
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * Contains cache port.
     * @var int $port
     */
    private int $port;

    /**
     * Returns cache port.
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Sets cache port.
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * Contains cache connection timeout.
     * @var int $timeout
     */
    private int $timeout;

    /**
     * Returns cache connection timeout.
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Sets cache connection timeout.
     * @param int $timeout
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    public function __construct()
    {
        $this->setHost('127.0.0.1');
        $this->setPort(11211);
        $this->setTimeout(1);
    }

    /**
     * Shortcut for creating memcache instance.
     * @return Memcached
     * @throws Exception
     */
    public function getMemcached(): Memcached
    {
        $memcached = new Memcached();

        if ($memcached->addServer($this->getHost(), $this->getPort()))
        {
            return $memcached;
        }
        else
        {
            throw new Exception("{$memcached->getResultCode()}: {$memcached->getResultMessage()}");
        }
    }

    /**
     * Shortcut for creating cache instance by array from config.
     * @param array $array
     * @return Cache
     */
    public static function fromArray(array $array): Cache
    {
        $cache = new Cache();

        if (isset($array['host']))
            $cache->setHost($array['host']);
        if (isset($array['port']))
            $cache->setPort($array['port']);
        if (isset($array['timeout']))
            $cache->setTimeout($array['timeout']);

        return $cache;
    }
}