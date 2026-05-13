<?php
require_once './libs/router/router.php';
require_once './app/controllers/libros-api.controller.php';


// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('libros', 'GET', 'LibrosApiController', 'obtenerLibros');
$router->addRoute('libros/:id', 'GET', 'LibrosApiController', 'obtenerLibroPorId');
$router->addRoute('libros/:id', 'DELETE', 'LibrosApiController', 'eliminarLibro');
$router->addRoute('libros', 'POST', 'LibrosApiController', 'agregarLibro')

// rutea según recurso y método de la solicitud
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
