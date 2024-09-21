<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/database.php';
$router = require __DIR__ . '/../routes/api.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

error_log("Método: " . $method);
error_log("URI: " . $uri);

try {
    $router->handle($method, $uri);
} catch (Exception $e) {
    error_log("Error en el enrutamiento: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error', 'message' => $e->getMessage()]);
}