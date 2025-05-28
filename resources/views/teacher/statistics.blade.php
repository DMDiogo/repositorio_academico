@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Estatísticas das suas Publicações</h2>

                <!-- Cards de Estatísticas -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Total de Publicações -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
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
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
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

                    <!-- Total de Visualizações -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total de Visualizações</dt>
                                        <dd class="text-2xl font-semibold text-gray-900">{{ $totalViews }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Downloads por Tipo de Publicação -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Downloads por Tipo de Publicação</h3>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach($downloadsByType as $type => $count)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-gray-500">{{ $type }}</h4>
                                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $count }}</p>
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