<?php
class MovimentacaoEstoque {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function registrar($produto_id, $tipo, $quantidade, $preco_unitario, $observacao, $usuario_id) {
        $this->pdo->beginTransaction();
        
        try {
            // Registra movimentação
            $stmt = $this->pdo->prepare("
                INSERT INTO movimentacoes_estoque (produto_id, tipo, quantidade, preco_unitario, observacao, usuario_id) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$produto_id, $tipo, $quantidade, $preco_unitario, $observacao, $usuario_id]);
            
            // Atualiza estoque
            $operacao = $tipo === 'entrada' ? '+' : '-';
            $stmt = $this->pdo->prepare("UPDATE produtos SET estoque_atual = estoque_atual $operacao ? WHERE id = ?");
            $stmt->execute([$quantidade, $produto_id]);
            
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollback();
            return false;
        }
    }
    
    public function listar($usuario_id, $limite = 50) {
        $stmt = $this->pdo->prepare("
            SELECT m.*, p.nome as produto_nome 
            FROM movimentacoes_estoque m 
            JOIN produtos p ON m.produto_id = p.id 
            WHERE m.usuario_id = ? 
            ORDER BY m.criado_em DESC 
            LIMIT ?
        ");
        $stmt->execute([$usuario_id, $limite]);
        return $stmt->fetchAll();
    }
}