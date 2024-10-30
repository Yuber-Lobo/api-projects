<?php
require_once __DIR__ . '/config/config.php';
require_once UTILS_PATH . 'Router.php';

use src\utils\Router;

$router = new Router();

// Redirige todas las solicitudes /api/* al archivo api/index.php
if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
    require __DIR__ . '/api/index.php';
    exit;
}

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
