<?php


namespace Framework\Model\MySQL;


use Framework\Exceptions\DBCloseException;
use Framework\Exceptions\DBConnectionException;
use Framework\Exceptions\DBQueryException;
use Framework\Model\Database;
use Framework\Model\DatabaseProvider;
use mysqli;

/**
 * Class MySQLProvider represents provider for mysql.
 * @package Framework\Model\MySQL
 */
class MySQLProvider extends Database implements DatabaseProvider
{
    public function __construct()
    {
        $this->connected = false;
    }

    /**
     * Contains mysql raw connection.
     * @var mysqli $connection
     */
    private mysqli $connection;

    /**
     * @var bool $connected
     */
    private bool $connected;

    /**
     * @inheritDoc
     */
    public function isConnected(): bool
    {
        return $this->connected;
    }

    /**
     * @inheritDoc
     */
    public function connect(): void
    {
        if ($this->isConnected())
        {
            throw new DBConnectionException('this provider already connected');
        }

        $this->connection = new mysqli($this->getHost(), $this->getUser(), $this->getPassword(), $this->getName(), $this->getPort());

        if ($this->connection->connect_error)
        {
            throw new DBConnectionException($this->connection->connect_error);
        }

        $this->connected = true;
    }

    /**
     * @inheritDoc
     */
    public function close(): void
    {
        if (!$this->isConnected())
            throw new DBCloseException('Connection already closed');

        if (!mysqli_close($this->connection))
        {
            throw new DBCloseException($this->connection->error);
        }

        $this->connected = false;
    }

    /**
     * @inheritDoc
     */
    public function query(string $query, bool $autoConnect = true)
    {
        if ($autoConnect && !$this->isConnected())
        {
            $this->connect();
        }

        $result = mysqli_query($this->connection, $query);

        if ($result === false)
        {
            throw new DBQueryException(mysqli_errno($this->connection). ': ' . mysqli_error($this->connection));
        }

        return $result === true ? $result : new MySQLResultProvider($result);
    }
}