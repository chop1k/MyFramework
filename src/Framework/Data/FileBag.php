<?php


namespace Framework\Data;


use Framework\File;

/**
 * Interface FileBag represents bag of files.
 * @package Framework\Data
 */
interface FileBag
{
    /**
     * Returns number of files.
     * @return int
     */
    public function count(): int;

    /**
     * Checks if bag contains file with given name.
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Returns file with given name.
     * @param string $key
     * @return File
     */
    public function get(string $key): File;

    /**
     * Sets file.
     * @param File $file
     * @return mixed
     */
    public function set(File $file);

    /**
     * Returns array of all files.
     * @return array
     */
    public function all(): array;
}