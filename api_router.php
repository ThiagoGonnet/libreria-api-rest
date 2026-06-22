<?php
require_once './libs/router/router.php';
require_once './app/controllers/libros-api-controller.php';


// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('libros', 'GET', 'LibrosApiController', 'obtenerLibros');
$router->addRoute('libros/:id', 'GET', 'LibrosApiController', 'obtenerLibroPorId');
$router->addRoute('libros/:id', 'DELETE', 'LibrosApiController', 'eliminarLibro');
$router->addRoute('libros', 'POST', 'LibrosApiController', 'agregarLibro');
$router->addRoute('libros/:id', 'PUT', 'LibrosApiController', 'actualizarLibro');

$router->addRoute('autores', 'GET', 'AutorApiController', 'obtenerAutores');
$router->addRoute('autores/:id', 'GET', 'AutorApiController', 'obtenerAutorPorId');
$router->addRoute('autores/:id', 'DELETE', 'AutorApiController', 'eliminarAutor');
$router->addRoute('autores', 'POST', 'AutorApiController', 'agregarAutor');
$router->addRoute('autores/:id', 'PUT', 'AutorApiController', 'actualizarAutores');

// rutea según recurso y método de la solicitud
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
