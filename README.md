# Rodando o Projeto

### 1. Versões

Laravel Framework 11.43.2
PHP 8.4.4 (cli) (built: Feb 11 2025 16:24:56) (NTS Visual C++ 2022 x64)
Composer version 2.8.5 2025-01-21 15:23:40
Node v22.11.0


### 2. **Instalar Dependências (Backend)**

```bash
composer install


2. Configurar Variáveis de Ambiente
Copie o arquivo de exemplo .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha


3. Gerar a Chave de Aplicação
php artisan key:generate


4. Rodar Migrações e Seeders
php artisan migrate --seed


5. Rodar o Servidor de Desenvolvimento
php artisan serve
O servidor estará disponível em http://localhost:8000.

6. Instalar Dependências (Frontend)
instale as dependências:
npm install


7. Rodar o Front-End (compilar assets)
npm run dev
