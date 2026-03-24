<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Session;
Session::start();

// Cargar variables de entorno si existe el archivo .env
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

// Cargar la configuración de la base de datos
$config = [
    'host'     => $_ENV['DB_HOST'] ?? 'localhost',
    'database' => $_ENV['DB_DATABASE'] ?? 'prueba_tecnica_jorge',
    'username' => $_ENV['DB_USERNAME'] ?? 'root',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
];

// Inicializar la conexión a la base de datos (Eloquent)
Database::init($config);

// Definir BASE_URL para manejar redirecciones y links en subdirectorios
$scriptPath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl = rtrim($scriptPath, '/public');
define('BASE_URL', $baseUrl);

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
