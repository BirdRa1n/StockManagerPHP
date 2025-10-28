<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
    protected function error(string $message, int $status = 400): void
    {
        $this->json(['error' => $message], $status);
    }
    protected function success(array $data = [], int $status = 200): void
    {
        $this->json($data, $status);
    }
}
