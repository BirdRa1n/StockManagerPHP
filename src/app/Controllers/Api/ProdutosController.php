<?php

namespace App\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Produto;

class ProdutosController
{
    use ApiResponseTrait;

    private $produto;

    public function __construct($pdo)
    {
        $this->produto = new Produto($pdo);
    }

    public function listar()
    {
        $headers = getallheaders();
        if (empty($headers['Authorization'])) {
            return $this->error('Token não fornecido', 401);
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $key = $_ENV['JWT_SECRET'] ?? 'chave_secreta_muito_forte';

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $usuario_id = $decoded->id;

            $produtos = $this->produto->listagemPaginada($usuario_id, $_GET['busca'] ?? '', $_GET['itens_por_pagina'] ?? 5, $_GET['pagina'] ?? 0);
            return $this->json($produtos);
        } catch (\Exception $e) {
            return $this->error('Token inválido', 401);
        }
    }
}
