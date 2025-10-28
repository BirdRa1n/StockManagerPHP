<?php
require_once '../app/Router.php';
require_once '../app/Controllers/DashboardController.php';
require_once '../app/Controllers/ProdutoController.php';

$router = new Router();

// Dashboard routes
$router->get('/dashboard', [new DashboardController($pdo), 'index']);

// Product routes
$router->get('/produtos', [new ProdutoController($pdo), 'index']);
$router->get('/produtos/create', [new ProdutoController($pdo), 'create']);
$router->post('/produtos/store', [new ProdutoController($pdo), 'store']);
$router->get('/produtos/edit/{id}', [new ProdutoController($pdo), 'edit']);
$router->post('/produtos/update/{id}', [new ProdutoController($pdo), 'update']);
$router->get('/produtos/delete/{id}', [new ProdutoController($pdo), 'delete']);

// Logout route
$router->get('/logout', function() {
    require_once '../app/auth.php';
    logout();
});

return $router;