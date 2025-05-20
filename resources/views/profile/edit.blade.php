@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- Cabeçalho do perfil -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6 text-white">
                <div class="flex items-center">
                    <div class="h-24 w-24 rounded-full bg-white text-blue-700 flex items-center justify-center text-3xl font-bold shadow-lg border-4 border-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="ml-6">
                        <h1 class="text-2xl font-bold">{{ Auth::user()->name }}</h1>
                        <p class="text-blue-100">Membro desde {{ Auth::user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Informações do perfil -->
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Informações do Perfil</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informações pessoais -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-medium text-gray-700 mb-4">Dados Pessoais</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nome</p>
                                <p class="text-gray-800">{{ Auth::user()->name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">E-mail</p>
                                <p class="text-gray-800">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tipo de Usuário</p>
                                <p class="text-gray-800">{{ Auth::user()->isTeacher() ? 'Professor' : 'Aluno' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Estatísticas -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-medium text-gray-700 mb-4">Estatísticas</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total de Publicações</p>
                                <p class="text-gray-800">{{ Auth::user()->publications()->count() }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Downloads Totais</p>
                                <p class="text-gray-800">{{ Auth::user()->publications()->sum('download_count') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Última Publicação</p>
                                <p class="text-gray-800">
                                    @if($lastPublication = Auth::user()->publications()->latest()->first())
                                        {{ $lastPublication->created_at->format('d/m/Y') }}
                                    @else
                                        Nenhuma publicação
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Preferências do sistema -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-700 border-b pb-2 mb-4">Preferências do Sistema</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-700">Notificações</p>
                                    <p class="text-xs text-gray-500">Ativadas</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-700">Segurança</p>
                                    <p class="text-xs text-gray-500">2FA Ativado</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-700">Tema</p>
                                    <p class="text-xs text-gray-500">Claro</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botões de ação -->
                <div class="mt-8 flex justify-end">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="-ml-1 mr-2 h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection