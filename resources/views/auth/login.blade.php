@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-6">Entrar</h2>
                
                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    
                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                        <input id="email" type="email" name="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required autofocus>
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                        <input id="password" type="password" name="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <a href="{{ url('/register') }}" class="text-sm text-blue-600 hover:text-blue-800 underline">
                                Não tem uma conta?
                            </a>
                        </div>
                        
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 