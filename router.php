<?php
require_once 'libs/router.php';

$router = new Router();

                // ENDPOINT  //VERB      //CONTROLLER         //METHOD
$router->addRoute('noticias', 'GET', 'NoticiasController', 'getNoticias');
$router->addRoute('noticias/:ID', 'GET', 'NoticiasController', 'getNoticia');
$router->addRoute('noticias', 'POST', 'NoticiasController', 'createNoticia');
$router->addRoute('noticias/:ID', 'DELETE', 'NoticiasController', 'deleteNoticia');
$router->addRoute('noticias/:ID', 'PUT', 'NoticiasController', 'updateNoticia');


$router->addRoute('secciones', 'GET', 'SeccionesController', 'getSecciones');
$router->addRoute('secciones/:ID', 'GET', 'SeccionesController', 'getSeccion');
$router->addRoute('secciones', 'POST', 'SeccionesController', 'createSeccion');
$router->addRoute('secciones/:ID', 'DELETE', 'SeccionesController', 'deleteSeccion');
$router->addRoute('secciones/:ID', 'PUT', 'SeccionesController', 'updateSeccion');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
