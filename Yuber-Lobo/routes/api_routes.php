<?php
// cSpell:disable

// Rutas para País
$router->addRoute('GET', '/api/paises', 'PaisController', 'getAll');
$router->addRoute('GET', '/api/paises/{id}', 'PaisController', 'getById');
$router->addRoute('GET', '/api/paises/search/{column}/{value}', 'PaisController', 'search');
$router->addRoute('GET', '/api/paises/departamentos', 'PaisController', 'getPaisesWithDepartamentos');
$router->addRoute('GET', '/api/paises/departamentos/ciudades', 'PaisController', 'getPaisesDepartamentosCiudades');
// $router->addRoute('POST', '/api/paises', 'PaisController', 'create');

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
$router->addRoute('GET', '/api/division-politica/completa', 'DivisionPoliticaController', 'getDivisionPolitica');
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


// Rutas para Destino
$router->addRoute('GET', '/api/destinos', 'DestinoController', 'getAll');
$router->addRoute('GET', '/api/destinos/{id}', 'DestinoController', 'getById');
$router->addRoute('POST', '/api/destinos', 'DestinoController', 'create');
$router->addRoute('GET', '/api/destinos/clase/{idClase}', 'DestinoController', 'getDestinosByClase');

// Rutas para Destino_códigos
$router->addRoute('GET', '/api/destino-codigos', 'DestinoCodigosController', 'getAll');
$router->addRoute('GET', '/api/destino-codigos/{id}', 'DestinoCodigosController', 'getById');
$router->addRoute('POST', '/api/destino-codigos', 'DestinoCodigosController', 'create');
$router->addRoute('GET', '/api/destino-codigos/destino/{idDestino}', 'DestinoCodigosController', 'getCodigosByDestino');

// Rutas para UnidadDeNegocio
$router->addRoute('GET', '/api/unidades-negocio', 'UnidadDeNegocioController', 'getAll');
$router->addRoute('GET', '/api/unidades-negocio/{id}', 'UnidadDeNegocioController', 'getById');
$router->addRoute('POST', '/api/unidades-negocio', 'UnidadDeNegocioController', 'create');

// Rutas para Materiales
$router->addRoute('GET', '/api/materiales', 'MaterialesController', 'getAll');
$router->addRoute('GET', '/api/materiales/{id}', 'MaterialesController', 'getById');
$router->addRoute('POST', '/api/materiales', 'MaterialesController', 'create');

// Rutas para Productos
$router->addRoute('GET', '/api/productos', 'ProductosController', 'getAll');
$router->addRoute('GET', '/api/productos/{id}', 'ProductosController', 'getById');
$router->addRoute('POST', '/api/productos', 'ProductosController', 'create');
$router->addRoute('GET', '/api/productos/material/{idMaterial}', 'ProductosController', 'getProductosByMaterial');

// Rutas para Clasificación
$router->addRoute('GET', '/api/clasificaciones', 'ClasificacionController', 'getAll');
$router->addRoute('GET', '/api/clasificaciones/{id}', 'ClasificacionController', 'getById');
$router->addRoute('POST', '/api/clasificaciones', 'ClasificacionController', 'create');
$router->addRoute('GET', '/api/clasificaciones/material/{idMaterial}/producto/{idProducto}', 'ClasificacionController', 'getClasificacionesByMaterialAndProducto');
