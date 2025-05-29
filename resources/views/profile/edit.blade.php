@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- Cabeçalho do perfil -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6 text-white">
                <div class="flex items-center">
                    <div class="h-24 w-24 rounded-full bg-white text-blue-700 flex items-center justify-center text-3xl font-bold shadow-lg border-4 border-white">
                        @php
                            $nameParts = explode(' ', Auth::user()->name);
                            $initials = strtoupper(substr($nameParts[0], 0, 1));
                            if (count($nameParts) > 1) {
                                $initials .= strtoupper(substr($nameParts[1], 0, 1));
                            }
                            echo $initials;
                        @endphp
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
                                <p class="text-gray-800">
                                    @if(Auth::user()->isAdmin())
                                        Administrador
                                    @elseif(Auth::user()->isTeacher())
                                        Professor
                                    @else
                                        Aluno
                                    @endif
                                </p>
                            </div>

                            @if(Auth::user()->isStudent())
                            <div>
                                <p class="text-sm font-medium text-gray-500">Curso</p>
                                <p class="text-gray-800">{{ Auth::user()->course ?? 'Não especificado' }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Estatísticas -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-medium text-gray-700 mb-4">Estatísticas</h3>
                        
                        <div class="space-y-3">
                            @if(!Auth::user()->isStudent())
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
                            @else
                            <div>
                                <p class="text-sm font-medium text-gray-500">Downloads Realizados</p>
                                <p class="text-gray-800">{{ Auth::user()->downloads()->count() }}</p>
                            </div>
                            @endif
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