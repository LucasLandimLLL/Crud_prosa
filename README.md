# Rodando o Projeto

### 1. Versões

Laravel Framework 11.43.2 <br/>
PHP 8.4.4 (cli) (built: Feb 11 2025 16:24:56) (NTS Visual C++ 2022 x64) <br/>
Composer version 2.8.5 2025-01-21 15:23:40 <br/>
Node v22.11.0


### 2. **Instalar Dependências (Backend)**


composer install


3. Configurar Variáveis de Ambiente
Copie o arquivo de exemplo .env:

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:Xy4Uzxps6gNMNVgpcjLI/gT28CrTlwaYJRIoXOJguHw=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000
FRONTEND_URL=http://localhost:3000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha


4. Gerar a Chave de Aplicação
php artisan key:generate


5. Rodar Migrações e Seeders
php artisan migrate --seed


6. Rodar o Servidor de Desenvolvimento
php artisan serve
O servidor estará disponível em http://localhost:8000.

7. Instalar Dependências (Frontend)
instale as dependências:
npm install


8. Rodar o Front-End (compilar assets)
npm run dev

