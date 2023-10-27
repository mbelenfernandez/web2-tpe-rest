<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'app/controllers/genero.api.controller.php';

    $router = new Router();

    #                 endpoint      verbo     controller           método
    $router->addRoute('generos',     'GET',    'GeneroApiController', 'get'   );
    $router->addRoute('generos',     'POST',   'GeneroApiController', 'create');
    $router->addRoute('generos/:ID', 'GET',    'GeneroApiController', 'get'   );
    $router->addRoute('generos/:ID', 'PUT',    'GeneroApiController', 'update');
    
    $router->addRoute('generos/:ID/:subrecurso', 'GET',    'TaskApiController', 'get'   );
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);