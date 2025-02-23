<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario; // Importe o modelo de usuários
use Illuminate\Support\Facades\Hash; // Use Hash para criptografar a senha

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Cria um usuário de exemplo
        Usuario::create([
            'name' => 'Primeiro Usuário',
            'email' => 'admin@example.com',
            'password' => Hash::make('senha123'), // Criptografa a senha
        ]);
    }
}