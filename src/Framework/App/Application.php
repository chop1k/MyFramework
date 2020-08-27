<?php


namespace Framework\App;

use Framework\Data\Bag;
use Framework\Http\Request;
use Framework\Routing\Route;
use Framework\Routing\Tag;

class Application
{
    /**
     * @var ApplicationConfig $config
     */
    protected ApplicationConfig $config;

    /**
     * @return ApplicationConfig
     */
    public function getConfig(): ApplicationConfig
    {
        return $this->config;
    }

    /**
     * @param ApplicationConfig $config
     */
    public function setConfig(ApplicationConfig $config): void
    {
        $this->config = $config;
    }

    public function handle()
    {
        $request = Request::createFromGlobals();

        $route = $this->findRoute($request);

        if (is_null($route))
        {
            return;
            // TODO: return 404 response
        }

        if (!in_array($request->getMethod(), $route->getMethods()))
        {
            return;
            // TODO: return 405 response
        }

        echo var_dump($route);
    }

    private function findRoute(Request $request): ?Route
    {
        $routes = require_once $this->getConfig()->getRoutesPath();

        $url = $request->getUrl();

        $parsedUrl = explode('/', parse_url($url, PHP_URL_PATH));

        $urlCount = count($parsedUrl);

        foreach ($routes as $name => $data)
        {
            $route = Route::fromArray($name, $data);

            $path = $route->getPath();

            if ($path == $url)
                return $route;

            $parsedPath = explode('/', $path);

            if ($urlCount !== count($parsedPath))
                continue;

            $copyUrl = $parsedUrl;

            $tags = $route->getTags();

            /**
             * @var Tag $tag
             */
            foreach ($tags as $tag)
            {
                if ($tag->getType() === 'integer' && !is_numeric($copyUrl[$tag->getStep()]))
                    continue;

                $copyUrl[$tag->getStep()] = ":{$tag->getName()}";
            }


            if (implode('/', $copyUrl) === $path)
            {
                foreach ($tags as $tag)
                {
                    if (is_null($tag->getValue()))
                        $tag->setValue($parsedUrl[$tag->getStep()]);
                }

                return $route;
            }
        }

        return null;
    }
}