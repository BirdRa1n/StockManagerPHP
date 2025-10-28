<?php

namespace App\Models;

class AuthController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function login()
    {
        require_once __DIR__ . '/../auth.php';
        require_once __DIR__ . '/../layout.php';

        if (isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }

        $erro = '';
        if ($_POST) {
            if (isset($_POST['acao']) && $_POST['acao'] === 'registrar') {
                $usuario = new Usuario($this->pdo);

                if ($usuario->criar($_POST['nome'], $_POST['email'], $_POST['senha'])) {
                    $erro = 'Usuário criado! Faça login.';
                } else {
                    $erro = 'Erro ao criar usuário.';
                }
            } else {
                if (login($_POST['email'], $_POST['senha'])) {
                    header('Location: /dashboard');
                    exit;
                } else {
                    $erro = 'Email ou senha inválidos.';
                }
            }
        }

        $this->render('auth/login', ['erro' => $erro]);
    }

    public function logout()
    {
        require_once __DIR__ . '/../auth.php';
        logout();
    }

    private function render($view, $data = [])
    {
        extract($data);
        require_once __DIR__ . '/../layout.php';
        renderHead('StockManager - Login');
        require_once __DIR__ . "/../Views/$view.php";
    }
}
