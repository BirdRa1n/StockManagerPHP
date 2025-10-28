<?php
require_once '../../app/auth.php';
require_once '../../config/database.php';
require_once '../../app/Controllers/ProdutoController.php';

$controller = new ProdutoController($pdo);
$controller->create();