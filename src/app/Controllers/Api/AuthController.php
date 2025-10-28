<?php

namespace App\Controllers\Api;

use App\Traits\ApiResponseTrait;
use App\Models\Usuario;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController
{
    use ApiResponseTrait;

    private $usuario;

    public function __construct($pdo)
    {
        $this->usuario = new Usuario($pdo);
    }

    public function register()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            return $this->error('Todos os campos são obrigatórios', 400);
        }

        if ($this->usuario->criar($data['nome'], $data['email'], $data['senha'])) {
            return $this->json(['message' => 'Usuário criado com sucesso'], 201);
        }

        return $this->error('Erro ao criar usuário', 500);
    }

    public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['email']) || empty($data['senha'])) {
            return $this->error('Email e senha são obrigatórios', 400);
        }

        $user = $this->usuario->buscarPorEmail($data['email']);
        if (!$user || !password_verify($data['senha'], $user['senha'])) {
            return $this->error('Credenciais inválidas', 401);
        }

        $token = JWT::encode([
            'id' => $user['id'],
            'nome' => $user['nome'],
            'exp' => time() + 3600
        ], $_ENV['JWT_SECRET'] ?? 'chave_secreta_muito_forte', 'HS256');

        return $this->json(['token' => $token, 'user' => ['nome' => $user['nome'], 'email' => $user['email']]]);
    }

    public function logout()
    {
        return $this->json(['message' => 'Logout realizado com sucesso']);
    }

    public function self()
    {
        $headers = getallheaders();
        if (empty($headers['Authorization'])) {
            return $this->error('Token não fornecido', 401);
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $key = $_ENV['JWT_SECRET'] ?? 'chave_secreta_muito_forte';

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // Use o ID do token (mais seguro que email)
            $user = $this->usuario->buscarPorId($decoded->id);
            if (!$user) {
                return $this->error('Usuário não encontrado', 404);
            }

            return $this->json([
                'nome' => $user['nome'],
                'email' => $user['email']
            ]);
        } catch (\Exception $e) {
            return $this->error('Token inválido', 401);
        }
    }
}
