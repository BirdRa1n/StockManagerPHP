<?php
require_once '../../config/database.php';
require_once '../../app/auth.php';
require_once '../../app/Models/Produto.php';

requireLogin();
$usuarioId = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'descricao' => $_POST['descricao'],
        'codigo_barras' => $_POST['codigo_barras'] ?? '',
        'preco_custo' => floatval(str_replace(',', '.', $_POST['preco_custo'] ?? 0)),
        'preco_venda' => floatval(str_replace(',', '.', $_POST['preco'] ?? 0)),
        'estoque_minimo' => intval($_POST['estoque_minimo'] ?? 0),
        'estoque_atual' => intval($_POST['estoque_atual'])
    ];

    $produtoModel = new Produto($pdo);
    if ($produtoModel->criar($dados, $usuarioId)) {
        header('Location: /produtos/lista.php');
        exit;
    } else {
        echo "Erro ao salvar o produto.";
    }
} else {
    header('Location: /produtos/adicionar');
    exit;
}
