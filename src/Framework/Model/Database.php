<?php


namespace Framework\Model;

/**
 * Class Database
 * @package Framework\Model
 */
class Database
{
    /**
     * Contains database host.
     * @var string $host
     */
    private string $host;

    /**
     * Returns database host.
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Sets database host.
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * Contains database user.
     * @var string $user
     */
    private string $user;

    /**
     * Returns database user.
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Sets database user.
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * Contains password.
     * @var string $password
     */
    private string $password;

    /**
     * Returns database password.
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets database password.
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Contains database name.
     * @var string $name
     */
    private string $name;

    /**
     * Returns database name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets database name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains database port.
     * @var int $port
     */
    private int $port;

    /**
     * Returns database port.
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Sets database port.
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }
}