<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameUserTableToUsuarios extends Migration
{
    public function up()
    {
        // Renomeia a tabela 'user' para 'usuarios'
        Schema::rename('users', 'usuarios');
    }

    public function down()
    {
        // Caso precise reverter, renomeia 'usuarios' para 'user'
        Schema::rename('usuarios', 'users');
    }
}
