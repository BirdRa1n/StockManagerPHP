<?php

use App\Controllers\Api\AuthController;
use App\Controllers\Api\ProdutosController;

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$authController = new AuthController($pdo);

$router->post('/api/auth/register', function () use ($authController) {
    $authController->register();
});

$router->post('/api/auth/login', function () use ($authController) {
    $authController->login();
});

$router->post('/api/auth/logout', function () use ($authController) {
    $authController->logout();
});

// Produtos API
$produtosController = new ProdutosController($pdo);

$router->get('/api/produtos', function () use ($produtosController) {
    $produtosController->listar();
});
