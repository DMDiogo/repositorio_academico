<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

// Rota para página de aprovação pendente
Route::get('/approval-pending', function () {
    return view('auth.approval-pending');
})->name('approval.pending');

// Rotas de aprovação de usuários
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::post('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::post('/users/{user}/reject', [UserController::class, 'reject'])->name('users.reject');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas (requerem autenticação)
Route::middleware(['web', 'auth', \App\Http\Middleware\CheckUserApproval::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Perfil do usuário
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    
    Route::patch('/profile', function () {
        return redirect()->back()->with('status', 'profile-updated');
    })->name('profile.update');
    
    Route::put('/password', function () {
        return redirect()->back()->with('status', 'password-updated');
    })->name('password.update');

    // Áreas
    Route::get('/areas', function () {
        return view('areas.index');
    })->name('areas.index');

    // Publicações
    Route::prefix('publicacoes')->group(function () {
        Route::get('/', [PublicationController::class, 'index'])->name('publications.index');
        Route::get('/criar', [PublicationController::class, 'create'])->name('publications.create');
        Route::post('/', [PublicationController::class, 'store'])->name('publications.store');
        Route::get('/{publication}', [PublicationController::class, 'show'])->name('publications.show');
        Route::get('/{publication}/download', [PublicationController::class, 'download'])->name('publications.download');
        Route::get('/{publication}/editar', [PublicationController::class, 'edit'])->name('publications.edit');
        Route::put('/{publication}', [PublicationController::class, 'update'])->name('publications.update');
        Route::delete('/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');
    });

    Route::get('/minhas-publicacoes', [PublicationController::class, 'myPublications'])
        ->name('publications.my-publications');

    // Gerenciamento de Usuários (apenas para administradores)
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
