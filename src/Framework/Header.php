<?php


namespace Framework;

/**
 * Class Header represents http header.
 * @package Framework
 */
class Header
{
    /**
     * Contains header name.
     * @var string $name
     */
    private string $name;

    /**
     * Returns header name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets header name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains header value.
     * @var string $value
     */
    private string $value;

    /**
     * Returns header value.
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets header value.
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}