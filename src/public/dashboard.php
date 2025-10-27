<?php
require_once '../app/layout.php';
require_once '../app/auth.php';

renderHead('StockManager - Dashboard');
?>

<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <a href="/logout" class="bg-red-600 text-white px-4 py-2 rounded">
            Sair
        </a>
    </header>
    <main class="p-6">
        <h2 class="text-xl font-semibold mb-4">Bem-vindo ao StockManager!</h2>
        <p>Esta é a sua área de controle de estoque.</p>
    </main>
</body>