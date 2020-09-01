<?php


namespace Framework;

/**
 * Class File represents file.
 * @package Framework
 */
class File
{
    /**
     * Contains file name.
     * @var string $name
     */
    private string $name;

    /**
     * Returns file name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets file name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains file type.
     * @var string $type
     */
    private string $type;

    /**
     * Returns file type.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets file type.
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Contains path to temporary file.
     * @var string $path
     */
    private string $path;

    /**
     * Return path to temporary file.
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Sets path to temporary file.
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * Contains size of file.
     * @var int $size
     */
    private int $size;

    /**
     * Returns size of file.
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Sets size of file.
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * Reads file and returns result.
     * @param int $size If size < 0 then file size will be used.
     * @return false|string
     */
    public function getContent(int $size = -1)
    {
        $file = fopen($this->path, 'r');

        $content = fread($file, $size < 0 ? $this->size : $size);

        fclose($file);

        return $content;
    }
}