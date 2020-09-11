<?php

use Framework\App\Application;
use Framework\App\ApplicationConfig;
use Framework\Env\Env;
use Framework\Http\Response;

require_once dirname(__DIR__).'/vendor/autoload.php';

/**
 * Requires loader.
 */
require_once dirname(__DIR__).'/src/Loader.php';

/**
 * Load scripts in accordance with config.
 */
Loader::load(dirname(__DIR__).'/src/', require_once dirname(__DIR__).'/config/paths.php');

/**
 * Creates a config and sets paths.
 */
$config = new ApplicationConfig();

$config->setRoutesPath(dirname(__DIR__).'/config/routes.php');
$config->setControllersPath(dirname(__DIR__).'/config/controllers.php');
$config->setSubscribersPath(dirname(__DIR__).'/config/subscribers.php');
$config->setFrameworkPath(dirname(__DIR__).'/config/framework.php');
$config->setMiddlewarePath(dirname(__DIR__).'/config/middleware.php');
$config->setQueriesPath(dirname(__DIR__).'/config/queries.php');
$config->setDatabasesPath(dirname(__DIR__).'/config/databases.php');
$config->setModelsPath(dirname(__DIR__).'/config/models.php');

try {
    /**
     * Gets and sets env values.
     */
    Env::fromJson(dirname(__DIR__).'/.env.json');

    /**
     * Starts application.
     */
    Application::start($config)->send();
} catch (Exception $exception)
{
    /**
     * If app throws exception then it returns response with status 500 and exception message.
     */
    Response::getInternalServerError($exception->getMessage())->send();
}
