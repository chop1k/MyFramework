<?php


namespace framework\data;


use framework\File;

interface FileBag
{
    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @return File
     */
    public function get(string $key): File;

    /**
     * @param File $file
     * @return mixed
     */
    public function set(File $file);

    /**
     * @return array
     */
    public function all(): array;
}