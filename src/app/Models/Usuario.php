<?php
class Usuario {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function criar($nome, $email, $senha) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT)]);
    }
    
    public function buscarPorEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND ativo = 1");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}