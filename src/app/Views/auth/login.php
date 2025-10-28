<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">StockManager</h1>
        
        <?php if ($erro): ?>
            <div class="mb-4 p-3 bg-red-100 border text-red-700 rounded"><?= $erro ?></div>
        <?php endif; ?>
        
        <div class="mb-4">
            <button onclick="toggleForm()" class="w-full bg-gray-200 py-2 rounded" id="toggleBtn">Criar Conta</button>
        </div>
        
        <form method="POST" class="space-y-4" id="loginForm">
            <input type="email" name="email" placeholder="Email" required class="w-full px-3 py-2 border rounded">
            <input type="password" name="senha" placeholder="Senha" required class="w-full px-3 py-2 border rounded">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Entrar</button>
        </form>
        
        <form method="POST" class="space-y-4 hidden" id="registerForm">
            <input type="hidden" name="acao" value="registrar">
            <input type="text" name="nome" placeholder="Nome" required class="w-full px-3 py-2 border rounded">
            <input type="email" name="email" placeholder="Email" required class="w-full px-3 py-2 border rounded">
            <input type="password" name="senha" placeholder="Senha" required class="w-full px-3 py-2 border rounded">
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded">Registrar</button>
        </form>
    </div>
    
    <script>
        function toggleForm() {
            const login = document.getElementById('loginForm');
            const register = document.getElementById('registerForm');
            const btn = document.getElementById('toggleBtn');
            
            if (login.classList.contains('hidden')) {
                login.classList.remove('hidden');
                register.classList.add('hidden');
                btn.textContent = 'Criar Conta';
            } else {
                login.classList.add('hidden');
                register.classList.remove('hidden');
                btn.textContent = 'Fazer Login';
            }
        }
    </script>
</body>
</html>