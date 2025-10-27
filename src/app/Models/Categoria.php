<?php
class Categoria {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function listar($usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categorias WHERE usuario_id = ? ORDER BY nome");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }
    
    public function criar($nome, $descricao, $usuario_id) {
        $stmt = $this->pdo->prepare("INSERT INTO categorias (nome, descricao, usuario_id) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $descricao, $usuario_id]);
    }
}