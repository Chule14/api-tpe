<?php
require_once 'libs/router.php';

$router = new Router();

                // ENDPOINT  //VERB      //CONTROLLER         //METHOD
$router->addRoute('noticias', 'GET', 'NoticiasController', 'getNoticias');
$router->addRoute('noticias/:id', 'GET', 'NoticiasController', 'getNoticia');


//$router->addRoute('tareas', 'POST', 'TaskApiController', 'crearTarea');
//$router->addRoute('tareas/:ID', 'GET', 'TaskApiController', 'obtenerTarea');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
