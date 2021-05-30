<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
use zinobe\helper\route\RouterHelper;
require_once 'vendor/autoload.php';
$router = new RouterHelper($_SERVER['REQUEST_URI']);

$router->add('/', 'zinobe\controller\InicioController::index');
$router->add('/busquedainicio', 'zinobe\controller\InicioController::buqueda');

$router->add('/validarDocumento/:documento', 'zinobe\controller\CustomerData::validarDocumento');
$router->add('/login/:documento/:clave', 'zinobe\controller\AutenticacionController::login');


$router->run();
?>