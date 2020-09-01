<?php


namespace Framework\Routing;

/**
 * Class Tag represents tag in route path
 * @package Framework\Routing
 */
class Tag
{
    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->value = null;
    }

    /**
     * Contains tag name.
     * @var string $name
     */
    private string $name;

    /**
     * Returns tag name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets tag name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Indicates when value can be null.
     * @var bool $nullable
     */
    private bool $nullable;

    /**
     * Returns true when value can be null.
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * Sets value of nullable.
     * @param bool $nullable
     */
    public function setNullable(bool $nullable): void
    {
        $this->nullable = $nullable;
    }

    /**
     * Contains step number.
     * @var int $step
     */
    private int $step;

    /**
     * Returns step.
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * Sets step.
     * @param int $step
     */
    public function setStep(int $step): void
    {
        $this->step = $step;
    }

    /**
     * Contains value type.
     * @var string $type
     */
    private string $type;

    /**
     * Returns value type.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets value type.
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Contains value.
     * @var mixed $value
     */
    private $value;

    /**
     * Returns value.
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets value.
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * Shortcut for creating tag from array.
     * @param string $name
     * @param array $array
     * @return Tag
     */
    public static function fromArray(string $name, array $array): Tag
    {
        $tag = new Tag();

        $tag->setName($name);
        $tag->setNullable($array['nullable']);
        $tag->setStep($array['step']);
        $tag->setType($array['type']);

        return $tag;
    }
}