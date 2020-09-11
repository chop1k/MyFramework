<?php


namespace Framework\Model;

/**
 * Interface DatabaseProvider represents interface which implements database functional.
 * @package Framework\Model
 */
interface DatabaseProvider
{
    public const MySQL = 1;

    /**
     * Returns true if connected.
     * @return bool
     */
    public function isConnected(): bool;

    /**
     * Connect to db.
     */
    public function connect(): void;

    /**
     * Closes connection to db.
     */
    public function close(): void;

    /**
     * Performs given query and returns result.
     * If provider not connected
     * @param string $query
     * @param bool $autoConnect
     * @return ResultProvider|bool
     */
    public function query(string $query, bool $autoConnect = true);
}