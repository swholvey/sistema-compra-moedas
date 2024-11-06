
# Sistema de Compra de Moedas

Este é um sistema web que permite aos usuários comprar moedas estrangeiras usando sua moeda local, com base nas taxas de câmbio fornecidas por uma API externa.

## Índice

1. [Descrição do Projeto](#descrição-do-projeto)
2. [Requisitos](#requisitos)
3. [Configuração do Ambiente](#configuração-do-ambiente)
4. [Instalação](#instalação)
5. [Execução do Projeto](#execução-do-projeto)
6. [APIs Disponíveis](#apis-disponíveis)
7. [Testes](#testes)
8. [Contribuição](#contribuição)

---

### 1. Descrição do Projeto

O sistema permite que o usuário realize operações de compra de moedas, aplicando uma taxa fixa de serviço sobre o montante da transação e integrando-se a uma API externa para obter as taxas de câmbio atualizadas.

### 2. Requisitos

- Docker
- Node.js (versão 18 ou superior) e npm para o front-end com Vue.js
- MySQL para o banco de dados

### 3. Configuração do Ambiente

#### Back-end

O projeto utiliza o Laravel com o Docker para rodar o ambiente de desenvolvimento do back-end, incluindo um servidor web, PHP, MySQL e o ambiente Laravel.

#### Front-end

O front-end usa Vue.js com o Vite para desenvolvimento. Está configurado para interagir com o back-end via API.

### 4. Instalação

1. **Clone o Repositório**

   ```bash
   git clone https://github.com/swholvey/gestaoclick.git
   cd sistema-compra-moedas
   ```

2. **Configuração do Docker**

   Certifique-se de que o Docker e o Docker Compose estão instalados. Configure as variáveis de ambiente no arquivo `.env` com as credenciais de banco de dados.

3. **Instalar Dependências do Back-end**

   Entre no container do Laravel e instale as dependências:

   ```bash
   docker-compose up -d
   docker-compose exec app bash
   composer install
   ```

4. **Migrar o Banco de Dados**

   No terminal do container, crie as tabelas do banco de dados:

   ```bash
   php artisan migrate
   ```

5. **Configuração do Front-end**

   Abra um terminal separado e navegue até a pasta `sistema-compra-moedas-frontend`:

   ```bash
   cd sistema-compra-moedas-frontend
   npm install
   ```

### 5. Execução do Projeto

#### Iniciar o Back-end

Inicie os serviços Docker e o servidor Laravel:

```bash
docker-compose up -d
```

#### Iniciar o Front-end

Inicie o servidor de desenvolvimento do Vue.js:

```bash
npm run dev
```

O front-end estará acessível em `http://localhost:5173`, e o back-end Laravel estará em `http://localhost:8000`.

### 6. APIs Disponíveis

O sistema fornece as seguintes rotas de API:

- **GET `/api/moedas`**: Lista as moedas disponíveis e suas taxas de câmbio.
- **POST `/api/calcula-total`**: Retorna o calculo total da compra (sem salvar no banco)
- **POST `/api/comprar`**: Realiza uma compra de moeda especificando a moeda e o montante, aplicando a taxa de serviço.
- **GET `/api/transacoes`**: Retorna o histórico de transações do usuário.

### 7. Testes

#### Testes do Back-end

Os testes de unidade estão configurados para validar a funcionalidade do back-end. Para rodar os testes:

1. Entre no container do Laravel:

   ```bash
   docker-compose exec app bash
   ```

2. Execute os testes:

   ```bash
   php artisan test
   ```

#### Testes do Front-end

Para o front-end, instale o Vitest para testes unitários:

```bash
npm run test
```

---

Este `README.md` fornece uma documentação completa para o projeto, orientando sobre a instalação, configuração, execução e teste da aplicação. Salve o conteúdo no arquivo e faça o commit para que fique disponível no repositório.