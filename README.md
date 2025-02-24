# Rodando o Projeto

### 1. Versões

Laravel Framework 11.43.2 <br/>
PHP 8.4.4 (cli) (built: Feb 11 2025 16:24:56) (NTS Visual C++ 2022 x64) <br/>
Composer version 2.8.5 2025-01-21 15:23:40 <br/>
Node v22.11.0<br/>
Banco de dados MySQL


### 2. **Instalar Dependências (Backend)**


composer install


### 3. Configurar Variáveis de Ambiente
Copie o arquivo de exemplo .env:

APP_NAME=Laravel <br/>
APP_ENV=local <br/>
APP_KEY= <br/>
APP_DEBUG=true <br/> 
APP_TIMEZONE=UTC <br/>
APP_URL=http://localhost:8000 <br/>
FRONTEND_URL=http://localhost:3000 <br/>

DB_CONNECTION=mysql <br/>
DB_HOST=127.0.0.1 <br/> 
DB_PORT=3306 <br/>
DB_DATABASE=nome_do_banco <br/>
DB_USERNAME=seu_usuario <br/>
DB_PASSWORD=sua_senha <br/>


### 4. Gerar a Chave de Aplicação
php artisan key:generate


### 5. Rodar Migrações e Seeders

php artisan migrate
<br/>
Crie o banco caso não tenha, escrevendo "yes" no console
<br/>
php artisan db:seed --class=UsersTableSeeder
<br/>



### 6. Rodar o Servidor de Desenvolvimento
php artisan serve <br/>
O servidor estará disponível em http://localhost:8000.

### 7. Instalar Dependências (Frontend)
instale as dependências:
npm i


### 8. Rodar o Front-End (compilar assets)
rode dependecias:
npm run dev

### 9. URLs do Projeto que necessitam atençã
Dashboard: http://localhost:8000/dashboard

Login: http://localhost:8000/login

Registro: http://localhost:8000/register

Observação: precisam ser recarregadas após serem abertas.

# Outras URLS
http://localhost:8000/ <br/><br/>
http://localhost:8000/profile <br/><br/>
http://localhost:8000/clientes <br/><br/>
http://localhost:8000/usuarios

### 10. Seeders populada do banco 
nome: Primeiro Usuário
Email:admin@example.com
Senha: senha123

### 11. Regras de Negócio 

# Permissões de Usuários:

Todos os usuários podem:

Atualizar seus próprios dados.

Adicionar, editar e excluir clientes.

Pesquisar clientes e outros usuários.

# Usuários não podem:

Alterar dados de outros usuários (apenas visualizar nome e email).

Proteção de Rotas:

Apenas usuários autenticados podem acessar as funcionalidades de CRUD.

Criptografia de Senhas:

As senhas dos usuários são criptografadas antes de serem armazenadas no banco de dados.

Integração com ViaCEP:

O endereço do cliente pode ser buscado automaticamente usando o CEP através da API do ViaCEP.

### 12. Seeders

Para Popular o banco pode ser usado essas duas criações de seeders

1. php artisan make:seeder UsuarioSeeder

```php

<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    /**
     * Executa o seed.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();  // Cria uma instância do Faker

        // Insere 50 usuários no banco de dados
        foreach (range(1, 50) as $index) {
            Usuario::create([  // Usando o modelo Usuario corretamente
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),  // Define uma senha padrão
            ]);
        }
    }
}
```

<br/> <br/>

para rodar o Seeder: <br/>
php artisan db:seed --class=UsuarioSeeder


2. php artisan make:seeder ClienteSeeder



Codigo para o arquivo:

```php

<?php

namespace Database\Seeders;

use App\Models\Cliente; 
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    /**
     * Executa o seed.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();  // Cria uma instância do Faker

        // Insere 50 clientes no banco de dados
        foreach (range(1, 50) as $index) {
            Cliente::create([  // Usando o modelo Cliente corretamente
                'nome' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'telefone' => $faker->phoneNumber,
                'cep' => $faker->postcode,
                'endereco' => $faker->streetAddress,
                'numero' => $faker->buildingNumber,
            ]);
        }
    }
}
```


<br/> <br/>
Rodar os seeders :<br/>
php artisan db:seed --class=ClienteSeeder

Acaso tenham alguma duvido, fico feliz em entrar em contato para responde-los quanto!
