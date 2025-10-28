# API de Autenticação - StockManagerPHP

API REST simples para autenticação de usuários.

## Base URL
```
http://localhost/api
```

## Endpoints

### 1. Registrar Usuário
**POST** `/auth/register`

**Body:**
```json
{
    "nome": "João Silva",
    "email": "joao@email.com",
    "senha": "123456"
}
```

**Resposta (201):**
```json
{
    "message": "Usuário criado com sucesso"
}
```

### 2. Login
**POST** `/auth/login`

**Body:**
```json
{
    "email": "joao@email.com",
    "senha": "123456"
}
```

**Resposta (200):**
```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "user": {
        "id": 1,
        "nome": "João Silva",
        "email": "joao@email.com"
    }
}
```

### 3. Logout
**POST** `/auth/logout`

**Resposta (200):**
```json
{
    "message": "Logout realizado com sucesso"
}
```

## Exemplos com cURL

### Registrar:
```bash
curl -X POST http://localhost/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"nome":"João Silva","email":"joao@email.com","senha":"123456"}'
```

### Login:
```bash
curl -X POST http://localhost/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"joao@email.com","senha":"123456"}'
```

### Logout:
```bash
curl -X POST http://localhost/api/auth/logout \
  -H "Content-Type: application/json"
```