<body class="bg-gray-100 min-h-screen">
    <form method="POST" action="/produtos/update/<?= $produto['id'] ?>" class="max-w-lg mx-auto bg-white p-6 rounded shadow-md mt-10">
        <h2 class="text-2xl font-bold mb-4">Editar Produto</h2>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" class="w-full px-3 py-2 border rounded"><?= htmlspecialchars($produto['descricao']) ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="codigo_barras">EAN</label>
            <input type="text" id="codigo_barras" name="codigo_barras" value="<?= htmlspecialchars($produto['codigo_barras']) ?>" class="w-full px-3 py-2 border rounded">
        </div>

        <div class="flex mb-4 justify-between gap-4">
            <div>
                <label class="text-gray-700" for="preco_custo">Preço de Custo</label>
                <input type="text" id="preco_custo" name="preco_custo" value="<?= number_format($produto['preco_custo'], 2, ',', '') ?>" required class="w-full px-3 py-2 border rounded">
            </div>

            <div>
                <label class="text-gray-700" for="preco">Preço de Venda</label>
                <input type="text" id="preco" name="preco" value="<?= number_format($produto['preco_venda'], 2, ',', '') ?>" required class="w-full px-3 py-2 border rounded">
            </div>
        </div>

        <div class="flex mb-4 justify-between gap-4">
            <div>
                <label class="text-gray-700 mb-2" for="estoque_minimo">Estoque Mínimo</label>
                <input type="number" id="estoque_minimo" name="estoque_minimo" value="<?= $produto['estoque_minimo'] ?>" class="w-full px-3 py-2 border rounded">
            </div>

            <div>
                <label class="text-gray-700 mb-2" for="estoque_atual">Estoque Atual</label>
                <input type="number" id="estoque_atual" name="estoque_atual" value="<?= $produto['estoque_atual'] ?>" required class="w-full px-3 py-2 border rounded">
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Atualizar</button>
        <a href="/produtos" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
    </form>
</body>