<?php
require_once __DIR__ . '/BaseController.php';

use App\Models\Produto;

class ProdutoController extends BaseController
{
    private $produtoModel;

    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->produtoModel = new Produto($pdo);
    }

    public function index()
    {
        $data = $this->produtoModel->listagemPaginada($_SESSION['usuario_id'], $_GET['busca'] ?? '', $_GET['itens_por_pagina'] ?? 5, $_GET['pagina'] ?? 0);
        $this->render('produtos/lista', [
            'title' => 'Produtos',
            'data' => $data
        ]);
    }

    public function create()
    {
        $this->render('produtos/adicionar', ['title' => 'Adicionar Produto']);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/produtos');
        }

        $dados = [
            'nome' => $_POST['nome'],
            'descricao' => $_POST['descricao'],
            'codigo_barras' => $_POST['codigo_barras'] ?? '',
            'preco_custo' => floatval(str_replace(',', '.', $_POST['preco_custo'] ?? 0)),
            'preco_venda' => floatval(str_replace(',', '.', $_POST['preco'] ?? 0)),
            'estoque_minimo' => intval($_POST['estoque_minimo'] ?? 0),
            'estoque_atual' => intval($_POST['estoque_atual'])
        ];

        if ($this->produtoModel->criar($dados, $_SESSION['usuario_id'])) {
            $this->redirect('/produtos');
        } else {
            echo "Erro ao salvar o produto.";
        }
    }

    public function edit($id)
    {
        $produto = $this->produtoModel->buscarPorId($id, $_SESSION['usuario_id']);
        if (!$produto) {
            $this->redirect('/produtos');
        }

        $this->render('produtos/editar', [
            'title' => 'Editar Produto',
            'produto' => $produto
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/produtos');
        }

        $dados = [
            'nome' => $_POST['nome'],
            'descricao' => $_POST['descricao'],
            'codigo_barras' => $_POST['codigo_barras'] ?? '',
            'preco_custo' => floatval(str_replace(',', '.', $_POST['preco_custo'] ?? 0)),
            'preco_venda' => floatval(str_replace(',', '.', $_POST['preco'] ?? 0)),
            'estoque_minimo' => intval($_POST['estoque_minimo'] ?? 0),
            'estoque_atual' => intval($_POST['estoque_atual'])
        ];

        if ($this->produtoModel->atualizar($id, $dados, $_SESSION['usuario_id'])) {
            $this->redirect('/produtos');
        } else {
            echo "Erro ao atualizar o produto.";
        }
    }

    public function delete($id)
    {
        if ($this->produtoModel->excluir($id, $_SESSION['usuario_id'])) {
            $this->redirect('/produtos');
        } else {
            echo "Erro ao excluir o produto.";
        }
    }
}
