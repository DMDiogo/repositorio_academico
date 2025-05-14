<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome_new');
});

Route::get('/publicacoes', function () {
    return view('publications.index');
});

Route::get('/areas', function () {
    return view('areas.index');
});

Route::get('/publicacoes/{id}', function ($id) {
    return view('publications.show');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas (requerem autenticação)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Perfil do usuário
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    
    // Rota para atualizar perfil (placeholder)
    Route::patch('/profile', function () {
        return redirect()->back()->with('status', 'profile-updated');
    })->name('profile.update');
    
    // Rota para atualizar senha (placeholder)
    Route::put('/password', function () {
        return redirect()->back()->with('status', 'password-updated');
    })->name('password.update');
});
