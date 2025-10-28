<?php
require_once '../app/auth.php';
require_once '../config/database.php';
require_once '../app/Controllers/DashboardController.php';

$controller = new DashboardController($pdo);
$controller->index();