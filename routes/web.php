<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Rota inicial (página de boas-vindas)
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Página Dashboard - Protegida por autenticação
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas autenticadas
Route::middleware('auth')->group(function () {
    // Rotas de perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para listar usuários
    Route::get('/usuarios', [ClienteController::class, 'listarUsuarios'])->name('usuarios.index');

    // Rotas para Clientes (CRUD)
    Route::resource('/clientes', ClienteController::class);
    Route::get('/createuser', [ClienteController::class, 'create'])->name('clientes.createuser');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});

// Rotas de Login e Registro
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    // Rota para listar usuários
    Route::get('/usuarios', [ClienteController::class, 'listarUsuarios'])->name('usuarios.index');
});

// Importando a autenticação padrão do Laravel
require __DIR__.'/auth.php';