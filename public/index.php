<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/vendor/autoload.php';

$app = \App\App::getInstance();
var_dump($app->getDatabase());