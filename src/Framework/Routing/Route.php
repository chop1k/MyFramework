<?php


namespace Framework\Routing;


class Route
{
    /**
     * @var string $name
     */
    protected string $name;

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
     * @var string $path
     */
    protected string $path;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @var string $controller
     */
    protected string $controller;

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @var array $methods
     */
    protected array $methods;

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }

    /**
     * @var array $tags
     */
    protected array $tags;

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function isCorrespondTags(array $explodedPath): bool
    {
        /**
         * @var Tag $tag
         */
        foreach ($this->tags as $tag)
        {
            if ($tag->getType() === 'integer' && !is_numeric($explodedPath[$tag->getStep()]))
                return false;
        }

        return true;
    }

    public function replacePathValuesWithNames(array $explodedPath): string
    {
        /**
         * @var Tag $tag
         */
        foreach ($this->tags as $tag)
        {
            $explodedPath[$tag->getStep()] = ":{$tag->getName()}";
        }

        return implode('/', $explodedPath);
    }

    public function computeTagsValues(array $explodedPath): void
    {
        /**
         * @var Tag $tag
         */
        foreach ($this->tags as $tag)
        {
            $tag->setValue($explodedPath[$tag->getStep()]);
        }
    }

    public static function fromArray(string $name, array $array): Route
    {
        $route = new Route();

        $route->setName($name);
        $route->setPath($array['path']);
        $route->setController($array['controller']);
        $route->setMethods($array['methods']);

        $tags = [];

        foreach ($array['tags'] as $key => $value)
        {
            $tags[] = Tag::fromArray($key, $value);
        }

        $route->setTags($tags);

        return $route;
    }
}