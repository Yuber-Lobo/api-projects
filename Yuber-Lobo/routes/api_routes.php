<?php
// Rutas para País
$router->addRoute('GET', '/api/paises', 'PaisController', 'getAll');
$router->addRoute('GET', '/api/paises/{id}', 'PaisController', 'getById');
$router->addRoute('GET', '/api/paises/search/{column}/{value}', 'PaisController', 'search');
$router->addRoute('POST', '/api/paises', 'PaisController', 'create');

// Rutas para Departamento
$router->addRoute('GET', '/api/departamentos', 'DepartamentoController', 'getAll');
$router->addRoute('GET', '/api/departamentos/{id}', 'DepartamentoController', 'getById');
$router->addRoute('GET', '/api/departamentos/search/{column}/{value}', 'DepartamentoController', 'search');
$router->addRoute('POST', '/api/departamentos', 'DepartamentoController', 'create');

// Rutas para Ciudad
$router->addRoute('GET', '/api/ciudades', 'CiudadController', 'getAll');
$router->addRoute('GET', '/api/ciudades/{id}', 'CiudadController', 'getById');
$router->addRoute('GET', '/api/ciudades/search/{column}/{value}', 'CiudadController', 'search');
$router->addRoute('POST', '/api/ciudades', 'CiudadController', 'create');

//Rutas para Division Política
$router->addRoute('GET', '/api/division-politica', 'DivisionPoliticaController', 'getAll');
$router->addRoute('GET', '/api/division-politica/{id}', 'DivisionPoliticaController', 'getById');
//$router->addRoute('GET', '/api/division-politica/search/{column}/{value}', 'DivisionPoliticaController', 'search');
$router->addRoute('GET', '/api/division-politica/pais/{id}/departamentos', 'DivisionPoliticaController', 'getDepartamentosByPais');
$router->addRoute('GET', '/api/division-politica/pais/{id}/departamentos/search/{term}', 'DivisionPoliticaController', 'searchDepartamentosByPais');
$router->addRoute('GET', '/api/division-politica/departamento/{id}/ciudades', 'DivisionPoliticaController', 'getCiudadesByDepartamento');
$router->addRoute('GET', '/api/division-politica/departamento/{id}/ciudades/search/{term}', 'DivisionPoliticaController', 'searchCiudadesByDepartamento');
$router->addRoute('POST', '/api/division-politica', 'DivisionPoliticaController', 'create');


//Rutas para Clase
$router->addRoute('GET', '/api/clases', 'ClaseController', 'getAll');
$router->addRoute('GET', '/api/clases/{id}', 'ClaseController', 'getById');
$router->addRoute('GET', '/api/clases/search/{column}/{value}', 'ClaseController', 'search');
$router->addRoute('POST', '/api/clases', 'ClaseController', 'create');

// Continúa agregando rutas para las demás tablas...

// Ejemplo de ruta para un método personalizado
$router->addRoute('GET', '/api/paises/codigo-range/{min}/{max}', 'PaisController', 'getPaisesByCodigoRange');