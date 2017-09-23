<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/vendor/autoload.php';

if(isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home';
}

if($page === 'home') {
    $controller = new \App\Controller\AppController();
    $controller->home();
}