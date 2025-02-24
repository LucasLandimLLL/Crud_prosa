<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Certifique-se de que está usando o modelo Usuario
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Valida os dados do formulário de registro
        $request->validate([
            'name' => 'required|string|max:255', // Nome do usuário, obrigatório, string e com tamanho máximo de 255 caracteres
            'email' => 'required|string|lowercase|email|max:255|unique:usuarios', // Email obrigatório, minúsculo, único e válido (corrigido para 'usuarios')
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Senha obrigatória, confirmada e com regras padrão
        ]);

        // Cria o novo usuário no banco de dados
        $user = Usuario::create([
            'name' => $request->name, // Nome do usuário
            'email' => $request->email, // Email do usuário
            'password' => Hash::make($request->password), // Senha do usuário (hash)
        ]);

        // Dispara o evento de registro de um novo usuário
        event(new Registered($user));

        // Realiza o login automático do usuário após o registro
        Auth::login($user);

        // Redireciona o usuário para o dashboard após o login
        return redirect(route('dashboard', absolute: false));
    }
}