<?php


namespace Framework\App;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\Controller;
use Framework\Bag;
use Framework\Env\Env;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routing\Route;
use Framework\Routing\Tag;
use ReflectionClass;

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

    public function handle(): Response
    {
        $request = Request::createFromGlobals();

        $route = $this->findRoute($request);

        if (is_null($route))
        {
            return new Response();
            // TODO: return 404 response
        }

        if (!in_array($request->getMethod(), $route->getMethods()))
        {
            return new Response();
            // TODO: return 405 response
        }

        /**
         * @var Tag $tag
         */
        foreach ($route->getTags() as $tag)
        {
            $request->getParams()->set($tag->getName(), $tag->getValue());
        }

        $controller = $this->findController($route);

        if (is_null($controller))
        {
            return new Response();
            // TODO: handle this case
        }

        $class = $controller->getClass();

        $instance = new $class();

        $this->reflect($class, $instance, [
            'request' => $request,
            'config' => $this->config()
        ]);

        $method = $controller->getMethod();

        if (!($instance instanceof AbstractController))
            throw new Exception('grgrgr'); // TODO: need normal exception

        $response = $instance->$method();

        if (!($response instanceof Response))
            throw new Exception('ffffgrgrgr'); // TODO: need normal exception

        return $response;
    }

    private function config(): Config
    {
        $config = new Config();

        $config->replace(require_once $this->getConfig()->getFrameworkPath());

        return $config;
    }

    private function reflect(string $name, object $instance, array $array)
    {
        $reflection = new ReflectionClass($name);

        foreach ($array as $key => $value)
        {
            $property = $reflection->getProperty($key);

            $property->setAccessible(true);
            $property->setValue($instance, $value);
        }
    }

    private function findController(Route $route): ?Controller
    {
        $controllers = require_once $this->getConfig()->getControllersPath();

        foreach ($controllers as $name => $controller)
        {
            if ($name !== $route->getController())
                continue;

            return Controller::fromArray($name, $controller);
        }

        return null;
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
                continue;

            foreach ($tags as $tag)
            {
                if (is_null($tag->getValue()))
                    $tag->setValue($parsedUrl[$tag->getStep()]);
            }

            return $route;
        }

        return null;
    }
}