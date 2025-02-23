<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica o usuário com base no login e senha fornecidos
        $request->authenticate();

        // Regenera a sessão para proteger contra ataques de fixação de sessão
        $request->session()->regenerate();

        // Redireciona o usuário para a página desejada, ou para o dashboard caso seja a primeira vez
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Faz o logout do usuário
        Auth::guard('web')->logout();

        // Invalida a sessão para garantir que os dados da sessão não sejam reutilizados
        $request->session()->invalidate();

        // Regenera o token CSRF para a próxima requisição
        $request->session()->regenerateToken();

        // Redireciona para a página inicial após o logout
        return redirect('/');
    }
}
