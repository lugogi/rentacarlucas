<?php
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) return;

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) require $file;
});

use App\Core\Router;
use App\Core\Session;
use App\Controllers\AuthController;
use App\Controllers\VehicleController;

Session::start();

$router = new Router();

$router->get('/', [VehicleController::class, 'index']);
$router->get('/public', [VehicleController::class, 'index']);
$router->get('/public/', [VehicleController::class, 'index']);

$router->get('/public/login', [AuthController::class, 'showLogin']);
$router->post('/public/login', [AuthController::class, 'login']);
$router->get('/public/register', [AuthController::class, 'showRegister']);
$router->post('/public/register', [AuthController::class, 'register']);
$router->post('/public/logout', [AuthController::class, 'logout']);

$router->get('/public/vehicles/create', [VehicleController::class, 'create']);
$router->post('/public/vehicles/store', [VehicleController::class, 'store']);
$router->get('/public/vehicles/edit', [VehicleController::class, 'edit']);
$router->post('/public/vehicles/update', [VehicleController::class, 'update']);
$router->post('/public/vehicles/delete', [VehicleController::class, 'delete']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);