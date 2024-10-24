<?php

require_once __DIR__ . '/../config/config.php';
require_once UTILS_PATH . 'Router.php';

use src\utils\Router;

$router = new Router();

$router->addRoute('GET', '/api/reglas', 'ApiController@reglas');
$router->addRoute('GET', '/api/qualityParameterReport', 'ApiController@qualityParameterReport');
$router->addRoute('POST', '/api/qualityParameterReport', 'ApiController@createQualityParameterReport'); 
$router->addRoute('GET', '/api/transaccion', 'ApiController@transacciones');
$router->addRoute('GET', '/api/fuente', 'ApiController@fuente');
$router->addRoute('GET', '/api/empresas', 'ApiController@empresas');
$router->addRoute('GET', '/api/proveedores', 'ApiController@proveedores');
$router->addRoute('GET', '/api/origenes', 'ApiController@origenes');
$router->addRoute('GET', '/api/clientes', 'ApiController@clientes');
$router->addRoute('GET', '/api/pilas', 'ApiController@pilas');
$router->addRoute('GET', '/api/departamentos', 'ApiController@departamentos');
$router->addRoute('GET', '/api/ciudades', 'ApiController@ciudades');
$router->addRoute('GET', '/api/clases', 'ApiController@clases');
$router->addRoute('GET', '/api/unidadesNegocio', 'ApiController@unidadesNegocio');
$router->addRoute('GET', '/api/productos', 'ApiController@productos');
$router->addRoute('GET', '/api/clasificaciones', 'ApiController@clasificaciones');
$router->addRoute('GET', '/api/destinos', 'ApiController@destinos');
$router->addRoute('GET', '/api/ordenCompra', 'ApiController@ordenCompra');
$router->addRoute('GET', '/api/tipoReporte', 'ApiController@tipoReporte');

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
