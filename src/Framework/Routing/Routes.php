<?php


namespace Framework\Routing;

/**
 * Class Routes
 * @package Framework\Routing
 */
class Routes
{
    /**
     * Shortcut to search route in accordance with given url.
     * @param array $routes
     * @param string $url
     * @return Route|null
     */
    public static function find(array $routes, string $url): ?Route
    {
        /**
         * Divides url on steps by slash.
         */
        $explodedUrl = explode('/', $url);

        $count = count($explodedUrl);

        foreach ($routes as $name => $route)
        {
            /**
             * Gets route.
             */
            $route = Route::fromArray($name, $route);

            if ($route->getPath() === $url)
                return $route;

            /**
             * Divides path on steps by slash.
             */
            $path = explode('/', $route->getPath());

            /**
             * Checks numbers of steps.
             */
            if (count($path) !== $count)
                continue;

            /**
             * Checking tags compliance.
             */
            if (!$route->isCorrespondTags($explodedUrl))
                continue;

            /**
             * Replaces values from path with tags names.
             */
            if ($route->replacePathValuesWithNames($explodedUrl) !== $route->getPath())
                continue;

            /**
             * Inserts path values to tags.
             */
            $route->computeTagsValues($path);

            return $route;
        }

        return null;
    }
}