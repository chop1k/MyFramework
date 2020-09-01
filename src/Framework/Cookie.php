<?php


namespace Framework;

/**
 * Class Cookie represents cookie.
 * @package Framework
 */
class Cookie
{
    /**
     * Contains cookie name.
     * @var string
     */
    protected string $name;

    /**
     * Returns cookie name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets cookie name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains cookie value.
     * @var string
     */
    protected string $value;

    /**
     * Returns cookie value
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets cookie value.
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}