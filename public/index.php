<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();


    /**Zona Publica */    
$router->get('/', [LoginController::class , 'login']);
$router->post('/', [LoginController::class , 'login']);
$router->get('/crear', [LoginController::class , 'crear']);
$router->post('/crear', [LoginController::class , 'crear']);
$router->get('/olvide', [LoginController::class , 'olvide']);
$router->post('/olvide', [LoginController::class , 'olvide']);
$router->get('/confirmar', [LoginController::class , 'confirmar']);
$router->get('/reestablecer', [LoginController::class , 'reestablecer']);
$router->post('/reestablecer', [LoginController::class , 'reestablecer']);





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();