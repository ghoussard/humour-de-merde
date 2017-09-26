<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/vendor/autoload.php';

session_start();

$app = \App\App::getInstance();
$app->run();