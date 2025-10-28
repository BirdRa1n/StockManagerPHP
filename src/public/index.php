<?php
require_once __DIR__ . '/../app/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Usuario;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($path, '/');
if (empty($path)) $path = '/';

if ($path === '/') {
    require_once __DIR__ . '/../app/layout.php';

    if (isLoggedIn()) {
        header('Location: /dashboard');
        exit;
    }

    $erro = '';
    if ($_POST) {
        if (isset($_POST['acao']) && $_POST['acao'] === 'registrar') {
            $usuario = new Usuario($pdo);
            $erro = $usuario->criar($_POST['nome'], $_POST['email'], $_POST['senha'])
                ? 'Usuário criado! Faça login.'
                : 'Erro ao criar usuário.';
        } else {
            $erro = login($_POST['email'], $_POST['senha'])
                ? (header('Location: /dashboard') && exit)
                : 'Email ou senha inválidos.';
        }
    }

    renderHead('StockManager - Login');
?>

    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">StockManager</h1>
            <?php if ($erro): ?>
                <div class="mb-4 p-3 <?= strpos($erro, 'criado') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?> border rounded"><?= $erro ?></div>
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
<?php
    exit;
}

$router = new Router();
if (str_starts_with($path, '/api')) {
    require_once __DIR__ . '/../routes/api.php';
} else {
    require_once __DIR__ . '/../routes/web.php';
}
$router->run();
