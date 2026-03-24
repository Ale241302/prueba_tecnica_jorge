<?php

use App\Core\Database;
use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\DocumentController;

// Cargar el autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Cargar la configuración de la base de datos
$config = require_once __DIR__ . '/../config/database.php';

// Inicializar la conexión a la base de datos (Eloquent)
Database::init($config);

// Inicializar el Router
$router = new Router();

// Definir las rutas del sistema
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'processLogin']);
$router->get('/logout', [AuthController::class, 'logout']);

// Rutas de Documentos (CRUD)
$router->get('/documentos', [DocumentController::class, 'index']);
$router->get('/documentos/crear', [DocumentController::class, 'create']);
$router->post('/documentos/crear', [DocumentController::class, 'store']);
$router->get('/documentos/editar/{id}', [DocumentController::class, 'edit']);
$router->post('/documentos/editar/{id}', [DocumentController::class, 'update']);
$router->post('/documentos/eliminar/{id}', [DocumentController::class, 'destroy']);

// Redirigir la raíz / a /documentos
$router->get('/', [DocumentController::class, 'index']);

// Despachar la ruta actual
$router->dispatch();
