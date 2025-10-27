<?php
class Produto {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function listar($usuario_id) {
        $stmt = $this->pdo->prepare("
            SELECT p.*, c.nome as categoria_nome 
            FROM produtos p 
            LEFT JOIN categorias c ON p.categoria_id = c.id 
            WHERE p.usuario_id = ? AND p.ativo = 1 
            ORDER BY p.nome
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }
    
    public function criar($dados, $usuario_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO produtos (nome, descricao, codigo_barras, categoria_id, preco_custo, preco_venda, estoque_minimo, estoque_atual, usuario_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $dados['nome'], $dados['descricao'], $dados['codigo_barras'], 
            $dados['categoria_id'], $dados['preco_custo'], $dados['preco_venda'], 
            $dados['estoque_minimo'], $dados['estoque_atual'], $usuario_id
        ]);
    }
    
    public function buscarPorId($id, $usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $usuario_id]);
        return $stmt->fetch();
    }
}