<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiController;
use Controllers\AppController;
use Controllers\LoginController;
use MVC\Router;
$router = new Router();


    /**Zona Publica */    
$router->get('/', [LoginController::class , 'login']);
$router->post('/', [LoginController::class , 'login']);
$router->get('/logout', [LoginController::class , 'logout']);
$router->get('/crear', [LoginController::class , 'crear']);
$router->post('/crear', [LoginController::class , 'crear']);
$router->get('/olvide', [LoginController::class , 'olvide']);
$router->post('/olvide', [LoginController::class , 'olvide']);
$router->get('/confirmar', [LoginController::class , 'confirmar']);
$router->get('/reestablecer', [LoginController::class , 'reestablecer']);
$router->post('/reestablecer', [LoginController::class , 'reestablecer']);

    /**Zona Privada */
$router->get('/app', [AppController::class, 'app']);
$router->get('/direccion', [AppController::class, 'direccion']);
$router->post('/direccion', [AppController::class, 'direccion']);
$router->get('/editar-direccion', [AppController::class, 'editar_direccion']);
$router->post('/editar-direccion', [AppController::class, 'editar_direccion']);
$router->get('/perfil', [AppController::class, 'perfil']);
$router->post('/perfil', [AppController::class, 'perfil']);
$router->get('/cambiar-password', [AppController::class, 'cambiar_password']);
$router->post('/cambiar-password', [AppController::class, 'cambiar_password']);

/**Api */
$router->get('/api/servicios',[ApiController::class, 'index']);
$router->get('/api/direccion', [ApiController::class, 'direccionConsulta']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();