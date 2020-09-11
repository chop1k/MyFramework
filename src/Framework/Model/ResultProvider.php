<?php


namespace Framework\Model;

/**
 * Interface ResultProvider represents interface for access query result.
 * @package Framework\Model
 */
interface ResultProvider
{
    /**
     * Returns number of returned rows.
     * @return int
     */
    public function count(): int;

    /**
     * Returns array which represents row.
     * @return array
     */
    public function getRow(): array;

    /**
     * Returns false if no more results.
     * @return bool
     */
    public function next(): bool;

    /**
     * Liberates resources which used by query result.
     */
    public function free(): void;

    /**
     * Returns all fetched rows as array.
     * @return array
     */
    public function all(): array;
}