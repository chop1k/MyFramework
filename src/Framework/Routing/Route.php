<?php


namespace Framework\Routing;

/**
 * Class Route represents route.
 * @package Framework\Routing
 */
class Route
{
    /**
     * Contains name of route.
     * @var string $name
     */
    private string $name;

    /**
     * Returns name of route.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name of route.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Contains path of route.
     * @var string $path
     */
    private string $path;

    /**
     * Returns path of route.
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Sets path of route.
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * Contains controller name.
     * @var string $controller
     */
    private string $controller;

    /**
     * Returns controller name.
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Sets controller name.
     * @param string $controller
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * Contains array of supported methods.
     * @var array $methods
     */
    private array $methods;

    /**
     * Returns array of supported methods.
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * Sets array of supported methods.
     * @param array $methods
     */
    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }

    /**
     * Contains array of tags.
     * @var array $tags
     */
    private array $tags;

    /**
     * Returns array of tags.
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * Sets array of tags.
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * Checks if given path matches route tags.
     * @param array $explodedPath
     * @return bool
     */
    public function isCorrespondTags(array $explodedPath): bool
    {
        /**
         * @var Tag $tag
         */
        foreach ($this->getTags() as $tag)
        {
            if ($tag->getType() === 'integer' && !is_numeric($explodedPath[$tag->getStep()]))
                return false;
        }

        return true;
    }

    /**
     * Replaces path values with tags names.
     * @param array $explodedPath
     * @return string
     */
    public function replacePathValuesWithNames(array $explodedPath): string
    {
        /**
         * @var Tag $tag
         */
        foreach ($this->getTags() as $tag)
        {
            $explodedPath[$tag->getStep()] = ":{$tag->getName()}";
        }

        return implode('/', $explodedPath);
    }

    /**
     * Sets tags values to path values.
     * @param array $explodedPath
     */
    public function computeTagsValues(array $explodedPath): void
    {
        /**
         * @var Tag $tag
         */
        foreach ($this->getTags() as $tag)
        {
            $tag->setValue($explodedPath[$tag->getStep()]);
        }
    }

    public function __construct()
    {
        $this->tags = [];
    }

    /**
     * Shortcut to creating route from config.
     * @param string $name
     * @param array $array
     * @return Route
     */
    public static function fromArray(string $name, array $array): Route
    {
        $route = new Route();

        $route->setName($name);
        $route->setPath($array['path']);
        $route->setController($array['controller']);
        $route->setMethods($array['methods']);

        if (isset($array['tags']))
        {
            $tags = [];

            foreach ($array['tags'] as $key => $value)
            {
                $tags[] = Tag::fromArray($key, $value);
            }

            $route->setTags($tags);
        }

        return $route;
    }
}