<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Preenche o modelo do usuário com os dados validados
        $request->user()->fill($request->validated());

        // Se o e-mail foi alterado, redefine a verificação do e-mail
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Salva as alterações no banco de dados
        $request->user()->save();

        // Redireciona de volta para a página de edição do perfil
        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Valida a senha fornecida pelo usuário
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        // Obtém o usuário autenticado
        $user = $request->user();

        // Realiza o logout do usuário
        Auth::logout();

        // Exclui o usuário do banco de dados
        $user->delete();

        // Invalida a sessão e regenera o token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireciona para a página inicial
        return Redirect::to('/');
    }
}