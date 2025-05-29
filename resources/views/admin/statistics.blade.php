@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Estatísticas do Sistema</h2>

                <!-- Cards de Estatísticas Principais -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Total de Usuários -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total de Usuários</dt>
                                        <dd class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</dd>
                                        <dd class="text-sm text-gray-500">
                                            {{ $totalTeachers }} professores, {{ $totalStudents }} alunos
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total de Publicações -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total de Publicações</dt>
                                        <dd class="text-2xl font-semibold text-gray-900">{{ $totalPublications }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total de Downloads -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total de Downloads</dt>
                                        <dd class="text-2xl font-semibold text-gray-900">{{ $totalDownloads }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Solicitações Pendentes e Rejeitadas -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Solicitações de Usuários</h3>
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <!-- Pendentes -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Pendentes de Aprovação</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-yellow-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-yellow-800">Professores</p>
                                        <p class="text-2xl font-semibold text-yellow-900">{{ $pendingTeachers }}</p>
                                    </div>
                                    <div class="bg-yellow-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-yellow-800">Alunos</p>
                                        <p class="text-2xl font-semibold text-yellow-900">{{ $pendingStudents }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rejeitados -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Usuários Rejeitados</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-red-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-red-800">Professores</p>
                                        <p class="text-2xl font-semibold text-red-900">{{ $rejectedTeachers }}</p>
                                    </div>
                                    <div class="bg-red-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-red-800">Alunos</p>
                                        <p class="text-2xl font-semibold text-red-900">{{ $rejectedStudents }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publicações por Tipo -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Publicações por Tipo</h3>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach($publicationsByType as $type)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-gray-500">{{ $type->publicationType->name }}</h4>
                                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $type->count }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publicações Mais Baixadas -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Publicações Mais Baixadas</h3>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <ul class="divide-y divide-gray-200">
                            @foreach($mostDownloaded as $publication)
                            <li class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $publication->title }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $publication->publicationType->name }} - {{ $publication->download_count }} downloads
                                        </p>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('publications.show', $publication) }}" class="text-blue-600 hover:text-blue-900">
                                            Ver detalhes
                                        </a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Downloads Recentes -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Downloads Recentes</h3>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <ul class="divide-y divide-gray-200">
                            @foreach($recentDownloads as $download)
                            <li class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $download->publication->title }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Baixado por {{ $download->user->name }} em {{ $download->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 