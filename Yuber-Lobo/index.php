<?php
require_once __DIR__ . '/config/config.php';
require_once UTILS_PATH . 'Router.php';

use src\utils\Router;
$router = new Router();

$router->addRoute('GET', '/', 'HomeController@index');
// Añade aquí más rutas para la aplicación web si es necesario

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
