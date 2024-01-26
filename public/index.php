<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\BlogController;
use Controllers\PaginasController;
use Controllers\LoginController;

$router = new Router;

$router->get('/admin', [PropiedadController::class, 'index']);

$router->get('/propiedades/crear', [PropiedadController::class, 'create']);
$router->post('/propiedades/crear', [PropiedadController::class, 'create']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'update']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'update']);
$router->get('/propiedades/eliminar', [PropiedadController::class, 'delete']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'delete']);

$router->get('/vendedores/crear', [VendedorController::class, 'create']);
$router->post('/vendedores/crear', [VendedorController::class, 'create']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'update']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'update']);
$router->get('/vendedores/eliminar', [VendedorController::class, 'delete']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'delete']);

$router->get('/blog/crear', [BlogController::class, 'create']);
$router->post('/blog/crear', [BlogController::class, 'create']);
$router->get('/blog/actualizar', [BlogController::class, 'update']);
$router->post('/blog/actualizar', [BlogController::class, 'update']);
$router->get('/blog/eliminar', [BlogController::class, 'delete']);
$router->post('/blog/eliminar', [BlogController::class, 'delete']);

$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->comprobarRutas();
