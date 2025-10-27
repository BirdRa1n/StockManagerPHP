<?php
session_start();
require_once '../config/database.php';

function login($email, $senha) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ? AND ativo = 1");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();
    
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
    header('Location: /');
    exit;
}

function isLoggedIn() {
    return isset($_SESSION['usuario_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /');
        exit;
    }
}