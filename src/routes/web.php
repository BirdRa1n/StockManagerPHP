<?php
require_once '../app/Router.php';
require_once '../app/Controllers/DashboardController.php';
require_once '../app/Controllers/ProdutoController.php';

$router = new Router();

// Dashboard routes
$router->get('/dashboard', function () use ($pdo) {
    $controller = new DashboardController($pdo);
    return $controller->index();
});

// Product routes
$router->get('/produtos', function () use ($pdo) {
    $controller = new ProdutoController($pdo);
    return $controller->index();
});

$router->get('/produtos/create', function () use ($pdo) {
    $controller = new ProdutoController($pdo);
    return $controller->create();
});

$router->post('/produtos/store', function () use ($pdo) {
    $controller = new ProdutoController($pdo);
    return $controller->store();
});

$router->get('/produtos/edit/{id}', function ($id) use ($pdo) {
    $controller = new ProdutoController($pdo);
    return $controller->edit($id);
});

$router->post('/produtos/update/{id}', function ($id) use ($pdo) {
    $controller = new ProdutoController($pdo);
    return $controller->update($id);
});

$router->get('/produtos/delete/{id}', function ($id) use ($pdo) {
    $controller = new ProdutoController($pdo);
    return $controller->delete($id);
});

// Logout route
$router->get('/logout', function () {
    require_once '../app/auth.php';
    logout();
});

return $router;
