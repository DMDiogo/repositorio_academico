<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\DashboardController;
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
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
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
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/publications/create', [PublicationController::class, 'create'])->name('publications.create');
    Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');
});
