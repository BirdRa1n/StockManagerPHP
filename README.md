# StockManagerPHP

Sistema completo de gestão de estoque desenvolvido em PHP com MySQL.

## Funcionalidades

- **Dashboard** - Visão geral com estatísticas do estoque
- **Gestão de Produtos** - Adicionar, editar, listar e excluir produtos
- **Gestão de Categorias** - Organização de produtos por categorias
- **Movimentações de Estoque** - Controle de entradas e saídas
- **Controle de Estoque** - Monitoramento de estoque mínimo
- **Autenticação** - Sistema de login por usuário
- **Valores Monetários** - Suporte a formato brasileiro (12,55)
- **API** - Estrutura preparada para endpoints REST

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
│   ├── Controllers/     # Controladores da aplicação
│   │   ├── AuthController.php      # Autenticação
│   │   ├── BaseController.php      # Controlador base
│   │   ├── DashboardController.php # Dashboard
│   │   └── ProdutoController.php   # Produtos
│   ├── Models/          # Classes de modelo
│   │   ├── Categoria.php           # Categorias
│   │   ├── MovimentacaoEstoque.php # Movimentações
│   │   ├── Produto.php             # Produtos
│   │   └── Usuario.php             # Usuários
│   ├── Views/           # Templates de visualização
│   │   ├── auth/        # Views de autenticação
│   │   ├── categorias/  # Views de categorias
│   │   ├── dashboard/   # Views do dashboard
│   │   └── produtos/    # Views de produtos
│   ├── Router.php       # Sistema de roteamento
│   ├── auth.php         # Sistema de autenticação
│   └── layout.php       # Layout base
├── config/
│   └── database.php     # Configuração do banco
└── public/              # Arquivos públicos
    ├── api/             # Endpoints da API
    ├── routes.php       # Definição das rotas
    ├── .htaccess        # Configuração de URLs amigáveis
    └── index.php        # Ponto de entrada da aplicação
```

## Uso

### Dashboard
- Acesse `/dashboard` após login
- Visualize total de produtos, estoque baixo e valor total

### Produtos
- **Listar**: `/produtos`
- **Adicionar**: `/produtos/create`
- **Editar**: `/produtos/edit/{id}`
- **Excluir**: `/produtos/delete/{id}`

### Categorias
- **Listar**: `/categorias`
- **Gerenciar**: Sistema integrado de categorização

### Formato de Preços
- Use vírgula como separador decimal: `12,55`
- Sistema converte automaticamente para formato do banco

## Banco de Dados

### Tabelas Principais
- `usuarios` - Dados dos usuários do sistema
- `categorias` - Categorias de produtos
- `produtos` - Produtos do estoque com relacionamento a categorias
- `movimentacoes_estoque` - Histórico completo de movimentações

### Estrutura de Produto
- `nome` - Nome do produto
- `descricao` - Descrição opcional
- `codigo_barras` - EAN/código de barras (único)
- `categoria_id` - Relacionamento com categoria
- `preco_custo` - Preço de custo (DECIMAL)
- `preco_venda` - Preço de venda (DECIMAL)
- `estoque_minimo` - Quantidade mínima
- `estoque_atual` - Quantidade atual
- `usuario_id` - Proprietário do produto

### Sistema de Movimentações
- Controle automático de estoque
- Tipos: entrada/saída
- Histórico completo com preços
- Transações seguras com rollback

## Desenvolvimento

### Adicionando Novas Funcionalidades
1. Crie o modelo em `app/Models/`
2. Crie o controlador em `app/Controllers/` (herde de BaseController)
3. Adicione as views em `app/Views/`
4. Configure as rotas em `public/routes.php`
5. Para APIs, adicione endpoints em `public/api/`

### Padrões do Código
- Use `requireLogin()` em páginas protegidas
- Valide dados com `floatval()` e `intval()`
- Escape output com `htmlspecialchars()`
- Utilize transações para operações críticas
- Mantenha relacionamentos de usuário em todas as operações

## Licença

MIT License
