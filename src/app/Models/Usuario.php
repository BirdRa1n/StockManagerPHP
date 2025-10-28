<?php

namespace App\Models;

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criar($nome, $email, $senha)
    {
        // Verifica se já existe um usuário com este email
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT)]);
    }

    public function buscarPorEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND ativo = 1");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ? AND ativo = 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
