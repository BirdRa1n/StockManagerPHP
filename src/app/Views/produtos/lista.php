<body class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex">
                <h1 class="text-3xl font-bold">Lista de Produtos</h1>
                <input type="text" id="searchInput" placeholder="Buscar..." class="ml-6 p-2 border rounded" onkeypress="if(event.key === 'Enter') filterTable()">
            </div>
            <a href="produtos/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Adicionar Produto
            </a>
        </div>

        <table class="w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3 border-b">Nome</th>
                    <th class="p-3 border-b">Descrição</th>
                    <th class="p-3 border-b">Preço</th>
                    <th class="p-3 border-b">Quantidade</th>
                    <th class="p-3 border-b">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['produtos'] as $produto): ?>
                    <tr>
                        <td class="p-3 border-b"><?= htmlspecialchars($produto['nome']) ?></td>
                        <td class="p-3 border-b"><?= htmlspecialchars($produto['descricao']) ?></td>
                        <td class="p-3 border-b">R$ <?= number_format($produto['preco_venda'], 2, ',', '.') ?></td>
                        <td class="p-3 border-b"><?= htmlspecialchars($produto['estoque_atual']) ?></td>
                        <td class="p-3 border-b">
                            <a href="/produtos/edit/<?= $produto['id'] ?>" class="text-blue-600 hover:text-blue-800">Editar</a>
                            <a href="/produtos/delete/<?= $produto['id'] ?>" class="text-red-600 hover:text-red-800 ml-2">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-5">
            <?php
            $totalPaginas = ceil($data['total'] / ($_GET['itens_por_pagina'] ?? 5));
            $paginaAtual = $_GET['pagina'] ?? 0;

            for ($i = 0; $i < $totalPaginas; $i++):
                $ativo = $i == $paginaAtual ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700';
            ?>
                <a href="/produtos?pagina=<?= $i ?>&itens_por_pagina=<?= $_GET['itens_por_pagina'] ?? 5 ?>&busca=<?= urlencode($_GET['busca'] ?? '') ?>" class="px-3 py-1 rounded <?= $ativo ?> mx-1"><?= $i + 1 ?></a>
            <?php endfor; ?>

        </div>
    </div>
</body>

<script>
    function filterTable() {
        let input = document.getElementById('searchInput');
        let filtro = input.value;

        window.location.href = '/produtos?busca=' + encodeURIComponent(filtro);
    }
</script>