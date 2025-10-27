<?php
class Produto {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function listar($usuario_id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM produtos 
            WHERE usuario_id = ? AND ativo = 1 
            ORDER BY nome
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }
    
    public function criar($dados, $usuario_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO produtos (nome, descricao, codigo_barras, preco_custo, preco_venda, estoque_minimo, estoque_atual, usuario_id, categoria_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NULL)
        ");
        return $stmt->execute([
            $dados['nome'], $dados['descricao'], $dados['codigo_barras'], 
            $dados['preco_custo'], $dados['preco_venda'], 
            $dados['estoque_minimo'], $dados['estoque_atual'], $usuario_id
        ]);
    }

    public function excluir($id, $usuario_id) {
        $stmt = $this->pdo->prepare("UPDATE produtos SET ativo = 0 WHERE id = ? AND usuario_id = ?");
        return $stmt->execute([$id, $usuario_id]);
    }
    
    public function buscarPorId($id, $usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $usuario_id]);
        return $stmt->fetch();
    }
    
    public function atualizar($id, $dados, $usuario_id) {
        $stmt = $this->pdo->prepare("
            UPDATE produtos SET nome = ?, descricao = ?, codigo_barras = ?, preco_custo = ?, preco_venda = ?, estoque_minimo = ?, estoque_atual = ? 
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([
            $dados['nome'], $dados['descricao'], $dados['codigo_barras'], 
            $dados['preco_custo'], $dados['preco_venda'], 
            $dados['estoque_minimo'], $dados['estoque_atual'], $id, $usuario_id
        ]);
    }
}