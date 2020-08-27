<?php

use Framework\App\Application;
use Framework\App\ApplicationConfig;

require_once dirname(__DIR__).'/vendor/autoload.php';

require_once dirname(__DIR__).'/src/Loader.php';

Loader::load(dirname(__DIR__).'/src/');

$config = new ApplicationConfig();

$config->setRoutesPath(dirname(__DIR__).'/config/routes.php');

$app = new Application();

$app->setConfig($config);

$app->handle();

echo var_dump($app);


//$url = 'http://username:password@hostname:9090/path?arg=value#anchor';
//
//echo var_dump(parse_url($url));
//echo var_dump(parse_url($url, PHP_URL_SCHEME));
//echo var_dump(parse_url($url, PHP_URL_USER));
//echo var_dump(parse_url($url, PHP_URL_PASS));
//echo var_dump(parse_url($url, PHP_URL_HOST));
//echo var_dump(parse_url($url, PHP_URL_PORT));
//echo var_dump(parse_url($url, PHP_URL_PATH));
//echo var_dump(parse_url($url, PHP_URL_QUERY));
//echo var_dump(parse_url($url, PHP_URL_FRAGMENT));

//echo var_export($HTTP_POST_FILES);
//echo var_export($HTTP_POST_VARS);
//echo var_export($http_response_header);
//echo var_export(file_get_contents('php://input'));
//echo var_export($argc);
//echo var_export($argv);
//echo var_export($HTTP_RAW_POST_DATA);
//echo var_export($_SERVER);
//echo var_export($_GET);
//echo var_export($_ENV);
//echo var_export($_COOKIE);
//echo var_export($_FILES);
//echo var_export($_POST);
//echo var_export($_SESSION);
