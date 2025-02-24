<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'usuarios'; // Define o nome da tabela como 'usuarios'

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Nome do usuário
        'email', // E-mail do usuário
        'password', // Senha do usuário
    ];

    /**
     * Atributos que devem ser ocultos para serialização.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Oculta a senha
        'remember_token', // Oculta o token de "lembrar"
    ];

    

    /**
     * Atributos que devem ser convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Converte o campo para o tipo datetime
        'password' => 'hashed', // Automatically hash the password
    ];
}