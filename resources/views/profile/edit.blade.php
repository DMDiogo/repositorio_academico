@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900">Informações do Perfil</h2>
                <p class="mt-1 text-sm text-gray-600">Atualize suas informações de perfil e endereço de e-mail.</p>
                
                <form class="mt-6 space-y-6" method="POST" action="{{ url('/profile') }}">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="Nome do Usuário" required autofocus>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="usuario@example.com" required>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900">Atualizar Senha</h2>
                <p class="mt-1 text-sm text-gray-600">Certifique-se de que sua conta esteja usando uma senha longa e aleatória para se manter segura.</p>
                
                <form class="mt-6 space-y-6" method="POST" action="{{ url('/password') }}">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Senha Atual</label>
                        <input id="current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="current-password">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha</label>
                        <input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="new-password">
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" autocomplete="new-password">
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">Atualizar Senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 