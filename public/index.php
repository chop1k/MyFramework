<?php

use Framework\App\Application;

require_once dirname(__DIR__).'/vendor/autoload.php';

require_once dirname(__DIR__).'/src/Loader.php';

Loader::load(dirname(__DIR__).'/src/');

$app = new Application();

echo var_dump($app);

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