<?php


namespace Framework\Model\MySQL;


use Framework\Model\ResultProvider;
use mysqli_result;

class MySQLResultProvider implements ResultProvider
{
    /**
     * MySQLResultProvider constructor.
     * @param mysqli_result|bool $result
     */
    public function __construct($result)
    {
        $this->result = $result;
        $this->pointer = 0;
    }

    /**
     * @var int $pointer
     */
    private int $pointer;

    /**
     * @var mysqli_result|bool $result
     */
    private $result;

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return mysqli_num_rows($this->result);
    }

    /**
     * @inheritDoc
     */
    public function getRow(): array
    {
        $this->pointer++;

        return mysqli_fetch_row($this->result);
    }

    /**
     * @inheritDoc
     */
    public function next(): bool
    {
        return $this->pointer >= $this->count() ? false : true;
    }

    /**
     * @inheritDoc
     */
    public function free(): void
    {
        mysqli_free_result($this->result);
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return mysqli_fetch_all($this->result);
    }
}