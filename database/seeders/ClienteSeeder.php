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
            Cliente::create([
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
