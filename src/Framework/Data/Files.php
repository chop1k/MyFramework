<?php


namespace Framework\Data;


use Framework\File;

/**
 * Class Files represents implementation of files bag.
 * @package Framework\Data
 */
class Files implements FileBag
{
    /**
     * Files constructor.
     */
    public function __construct()
    {
        $this->array = [];
    }

    /**
     * Contains array with all files.
     * @var array $array
     */
    private array $array;

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->array);
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return isset($this->array[$key]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): File
    {
        return $this->array[$key];
    }

    /**
     * @inheritDoc
     */
    public function set(File $file)
    {
        $this->array[$file->getName()] = $file;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->array;
    }

    /**
     * Shortcut for creating file bag from globals.
     * @return Files
     */
    public static function createFromGlobals(): Files
    {
        $files = new Files();

        foreach ($_FILES as $key => $value)
        {
            $file = new File();

            $file->setName($value['name']);
            $file->setType($value['type']);
            $file->setPath($value['tmp_name']);
            $file->setSize($value['size']);

            $files->set($file);
        }

        return $files;
    }
}