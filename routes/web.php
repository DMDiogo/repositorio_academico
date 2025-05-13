<?php

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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Placeholder para o perfil
Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');

// Placeholder para logout
Route::post('/logout', function () {
    return redirect('/');
})->name('logout');
