@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">Perfil</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Olá {{ Auth::user()->name }}, bem-vindo ao seu painel do Repositório Acadêmico.
                </p>
                
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Estatísticas do Usuário -->
                    <div class="bg-blue-50 overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Suas Publicações
                                        </dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-gray-900">
                                                0
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-blue-100 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ url('/publicacoes') }}" class="font-medium text-blue-700 hover:text-blue-900">
                                    Adicionar nova publicação
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Downloads -->
                    <div class="bg-green-50 overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Total de Downloads
                                        </dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-gray-900">
                                                0
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-100 px-5 py-3">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-green-700 hover:text-green-900">
                                    Ver estatísticas detalhadas
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Perfil -->
                    <div class="bg-purple-50 overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Seu Perfil
                                        </dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-lg font-semibold text-gray-900 truncate">
                                                {{ Auth::user()->email }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-purple-100 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ url('/profile') }}" class="font-medium text-purple-700 hover:text-purple-900">
                                    Editar perfil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Atividades Recentes -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Atividades Recentes</h3>
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul class="divide-y divide-gray-200">
                            <li class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            Bem-vindo ao Repositório Acadêmico
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Você criou sua conta com sucesso. Comece adicionando suas publicações acadêmicas para compartilhar com a comunidade.
                                        </p>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Novo
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 