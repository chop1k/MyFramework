<?php


namespace Framework\Routing;


use Exception;

class Tag
{
    public function __construct()
    {
        $this->value = null;
    }

    /**
     * @var string $name
     */
    private string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @var bool $nullable
     */
    private bool $nullable;

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @param bool $nullable
     */
    public function setNullable(bool $nullable): void
    {
        $this->nullable = $nullable;
    }

    /**
     * @var int $step
     */
    private int $step;

    /**
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * @param int $step
     */
    public function setStep(int $step): void
    {
        $this->step = $step;
    }

    /**
     * @var string $type
     */
    private string $type;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @var mixed $value
     */
    private $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

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