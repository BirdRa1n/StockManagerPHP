<?php
require_once '../app/Models/Categoria.php';

$categoriasModel = new Categoria($pdo);
$categorias = $categoriasModel->listar($_SESSION['usuario_id']);


//tabela de categorias
?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Categorias</h2>
    <a href="/categorias/adicionar.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Adicionar Categoria</a>
    <table class="min-w-full bg-white shadow-md rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nome</th>
                <th class="py-2 px-4 border-b">Descrição</th>
                <th class="py-2 px-4 border-b">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($categoria['nome']) ?></td>
                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($categoria['descricao']) ?></td>
                    <td class="py-2 px-4 border-b">
                        <a href="/categorias/editar.php?id=<?= $categoria['id'] ?>" class="text-blue-600 hover:underline mr-2">Editar</a>
                        <a href="/categorias/excluir.php?id=<?= $categoria['id'] ?>" class="text-red-600 hover:underline">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>