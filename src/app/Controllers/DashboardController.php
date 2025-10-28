<?php
require_once __DIR__ . '/BaseController.php';

use App\Models\Produto;

class DashboardController extends BaseController
{
    public function index()
    {
        $produtoModel = new Produto($this->pdo);
        $produtos = $produtoModel->listar($_SESSION['usuario_id']);
        $totalProdutos = count($produtos);

        $estoqueBaixo = 0;
        $valorTotal = 0;
        foreach ($produtos as $produto) {
            if ($produto['estoque_atual'] <= $produto['estoque_minimo']) {
                $estoqueBaixo++;
            }
            $valorTotal += $produto['preco_venda'] * $produto['estoque_atual'];
        }

        $this->render('dashboard/index', [
            'title' => 'Dashboard',
            'totalProdutos' => $totalProdutos,
            'estoqueBaixo' => $estoqueBaixo,
            'valorTotal' => $valorTotal
        ]);
    }
}
