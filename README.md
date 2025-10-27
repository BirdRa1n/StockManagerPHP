# StockManagerPHP

Sistema simples de gestão de estoque desenvolvido em PHP com MySQL.

## Funcionalidades

- **Dashboard** - Visão geral com estatísticas do estoque
- **Gestão de Produtos** - Adicionar, editar, listar produtos
- **Controle de Estoque** - Monitoramento de estoque mínimo
- **Autenticação** - Sistema de login por usuário
- **Valores Monetários** - Suporte a formato brasileiro (12,55)

## Tecnologias

- PHP 8+
- MySQL 8
- Docker & Docker Compose
- Tailwind CSS
- Nginx

## Instalação

### Com Docker (Recomendado)

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/StockManagerPHP.git
cd StockManagerPHP
```

2. Configure as variáveis de ambiente:
```bash
cp .env.exemple .env
```

3. Execute com Docker:
```bash
docker-compose up -d
```

4. Acesse: `http://localhost`

### Instalação Manual

1. Configure um servidor web (Apache/Nginx) apontando para `src/public/`
2. Configure MySQL e importe `init.sql`
3. Configure `.env` com dados do banco

## Estrutura do Projeto

```
src/
├── app/
│   ├── Models/          # Classes de modelo (Produto, Usuario)
│   ├── Views/           # Templates de visualização
│   ├── auth.php         # Sistema de autenticação
│   └── layout.php       # Layout base
├── config/
│   └── database.php     # Configuração do banco
└── public/              # Arquivos públicos
    ├── produtos/        # CRUD de produtos
    ├── dashboard.php    # Dashboard principal
    └── index.php        # Página de login
```

## Uso

### Dashboard
- Acesse `/dashboard.php` após login
- Visualize total de produtos, estoque baixo e valor total

### Produtos
- **Adicionar**: `/produtos/adicionar.php`
- **Listar**: `/produtos/lista.php`
- **Editar**: `/produtos/editar.php?id=X`

### Formato de Preços
- Use vírgula como separador decimal: `12,55`
- Sistema converte automaticamente para formato do banco

## Banco de Dados

### Tabelas Principais
- `usuarios` - Dados dos usuários
- `produtos` - Produtos do estoque
- `movimentacoes_estoque` - Histórico de movimentações

### Campos de Produto
- `nome` - Nome do produto
- `descricao` - Descrição opcional
- `codigo_barras` - EAN/código de barras
- `preco_custo` - Preço de custo (DECIMAL)
- `preco_venda` - Preço de venda (DECIMAL)
- `estoque_minimo` - Quantidade mínima
- `estoque_atual` - Quantidade atual

## Desenvolvimento

### Adicionando Novas Funcionalidades
1. Crie o modelo em `app/Models/`
2. Adicione as rotas em `public/`
3. Use `auth.php` para controle de acesso

### Padrões do Código
- Use `requireLogin()` em páginas protegidas
- Valide dados com `floatval()` e `intval()`
- Escape output com `htmlspecialchars()`

## Licença

MIT License
