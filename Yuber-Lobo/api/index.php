<?php

require_once __DIR__ . '/../config/config.php';
require_once UTILS_PATH . 'Router.php';

use src\utils\Router;

$router = new Router();

$router->addRoute('GET', '/api/clasificacion', 'ApiController@clasificacion');
$router->addRoute('GET', '/api/productos', 'ApiController@productos');
$router->addRoute('GET', '/api/ciudades', 'ApiController@ciudades');
$router->addRoute('GET', '/api/proveedores', 'ApiController@proveedores');
$router->addRoute('GET', '/api/origenes', 'ApiController@origenes');

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
