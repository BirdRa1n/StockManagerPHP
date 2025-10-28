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

## Estrutura do Projeto (MVC)

```
src/
├── app/
│   ├── Controllers/     # Controladores (ProdutoController, DashboardController)
│   ├── Models/          # Classes de modelo (Produto, Usuario)
│   ├── Views/           # Templates de visualização
│   │   ├── produtos/    # Views de produtos
│   │   ├── dashboard/   # Views do dashboard
│   │   └── auth/        # Views de autenticação
│   ├── Router.php       # Sistema de roteamento
│   ├── auth.php         # Sistema de autenticação
│   └── layout.php       # Layout base
├── config/
│   └── database.php     # Configuração do banco
└── public/              # Arquivos públicos
    ├── routes.php       # Definição das rotas
    ├── .htaccess        # Configuração de URLs amigáveis
    └── index.php        # Ponto de entrada da aplicação
```

## Uso

### Dashboard
- Acesse `/dashboard` após login
- Visualize total de produtos, estoque baixo e valor total

### Produtos
- **Adicionar**: `/produtos/create`
- **Listar**: `/produtos`
- **Editar**: `/produtos/edit/{id}`

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
2. Crie o controlador em `app/Controllers/`
3. Adicione as views em `app/Views/`
4. Configure as rotas em `public/routes.php`

### Padrões do Código
- Use `requireLogin()` em páginas protegidas
- Valide dados com `floatval()` e `intval()`
- Escape output com `htmlspecialchars()`

## Licença

MIT License
