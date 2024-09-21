<?php

require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../src/Controllers/PaisController.php';
require_once __DIR__ . '/../src/Controllers/DepartamentoController.php';
require_once __DIR__ . '/../src/Controllers/CiudadController.php';
require_once __DIR__ . '/../src/Controllers/DivisionPoliticaController.php';
require_once __DIR__ . '/../src/Controllers/ClaseController.php';


$router = new Router();

// Rutas para Paises
$router->add(['GET', 'POST'], '/api/paises', 'PaisController', 'index');
$router->add('GET', '/api/paises/:id', 'PaisController', 'show');

// Rutas para Departamentos
$router->add(['GET', 'POST'], '/api/departamentos', 'DepartamentoController', 'index');
$router->add('GET', '/api/departamentos/:id', 'DepartamentoController', 'show');

// Rutas para Ciudades
$router->add(['GET', 'POST'], '/api/ciudades', 'CiudadController', 'index');
$router->add('GET', '/api/ciudades/:id', 'CiudadController', 'show');

// Rutas para Clase
$router->add('GET', '/api/clases', 'ClaseController', 'index');
$router->add('GET', '/api/clases/:id', 'ClaseController', 'show');

// Rutas para DivisionPolitica
$router->add('GET', '/api/division-politica', 'DivisionPoliticaController', 'index');
$router->add('GET', '/api/division-politica/pais/:id', 'DivisionPoliticaController', 'getDetailedStructureByPais');
$router->add('GET', '/api/division-politica/pais/:id/departamentos', 'DivisionPoliticaController', 'getDepartamentos');
$router->add('GET', '/api/division-politica/pais/:id/ciudades', 'DivisionPoliticaController', 'getCiudades');
return $router;