<?php
require_once 'libs/router.php';
require_once 'config.php';
require_once 'app/controllers/genero.api.controller.php';
require_once 'app/controllers/cancion.api.controller.php';
require_once 'app/controllers/comentario.api.controller.php';

$router = new Router();

#generos
$router->addRoute('generos',     'GET',    'GeneroApiController', 'get');
$router->addRoute('generos',     'POST',   'GeneroApiController', 'create');
$router->addRoute('generos/:ID', 'GET',    'GeneroApiController', 'get');
$router->addRoute('generos/:ID', 'PUT',    'GeneroApiController', 'update');
$router->addRoute('generos/:ID/:subrecurso', 'GET',    'GeneroApiController', 'get');

#canciones
$router->addRoute('canciones',     'GET',    'CancionApiController', 'get');
$router->addRoute('canciones',     'POST',   'CancionApiController', 'create');
$router->addRoute('canciones/:ID', 'GET',    'CancionApiController', 'get');
$router->addRoute('canciones/:ID', 'PUT',    'CancionApiController', 'update');
$router->addRoute('canciones/:ID/:subrecurso', 'GET',    'CancionApiController', 'get');

#comentarios
$router->addRoute('comentarios',     'GET',    'ComentarioApiController', 'get');
$router->addRoute('comentarios',     'POST',   'ComentarioApiController', 'create');
$router->addRoute('comentarios/:ID', 'GET',    'ComentarioApiController', 'get');
$router->addRoute('comentarios/:ID', 'PUT',    'ComentarioApiController', 'update');
$router->addRoute('comentarios/:ID/:subrecurso', 'GET',    'ComentarioApiController', 'get');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
