<?php
require_once '../../config/database.php';
require_once '../../app/auth.php';
require_once '../../app/Models/Produto.php';

requireLogin();
$usuarioId = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $produtoId = $_GET['id'];

    $produtoModel = new Produto($pdo);
    if ($produtoModel->excluir($produtoId, $usuarioId)) {
        header('Location: /produtos/lista.php');
        exit;
    } else {
        echo "Erro ao excluir o produto.";
    }
    
} else {
    header('Location: /produtos/adicionar');
    exit;
}
