<?php


namespace Framework\Routing;


class Routes
{
    public static function find(array $routes, string $url): ?Route
    {
        $explodedUrl = explode('/', $url);

        $count = count($explodedUrl);

        foreach ($routes as $name => $route)
        {
            $route = Route::fromArray($name, $route);

            if ($route->getPath() === $url)
                return $route;

            $path = explode('/', $route->getPath());

            if (count($path) !== $count)
                continue;


            if (!$route->isCorrespondTags($explodedUrl))
                continue;


            if ($route->replacePathValuesWithNames($explodedUrl) !== $route->getPath())
                continue;

            $route->computeTagsValues($path);

            return $route;
        }

        return null;
    }
}