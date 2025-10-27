<?php
require_once '../config/database.php';
require_once '../app/auth.php';
require_once '../app/Models/Produto.php';
require_once '../app/layout.php';

requireLogin();

$produtoModel = new Produto($pdo);
$produtos = $produtoModel->listar($_SESSION['usuario_id']);
$totalProdutos = count($produtos);

$estoqueBaixo = 0;
$valorTotal = 0;
foreach ($produtos as $produto) {
    if ($produto['estoque_atual'] <= $produto['estoque_minimo']) {
        $estoqueBaixo++;
    }
    $valorTotal += $produto['preco_venda'] * $produto['estoque_atual'];
}

renderHead('Dashboard');
?>

<body class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Sair</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Total de Produtos</h2>
                <p class="text-3xl font-bold text-blue-600"><?= $totalProdutos ?></p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Estoque Baixo</h2>
                <p class="text-3xl font-bold text-red-600"><?= $estoqueBaixo ?></p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Valor Total</h2>
                <p class="text-3xl font-bold text-green-600">R$ <?= number_format($valorTotal, 2, ',', '.') ?></p>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Ações Rápidas</h2>
            <div class="flex gap-4">
                <a href="produtos/adicionar.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Adicionar Produto
                </a>
                <a href="produtos/lista.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Ver Produtos
                </a>
            </div>
        </div>
    </div>
</body>