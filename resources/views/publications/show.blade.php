@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Navegação -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">
            <li>
                <div>
                    <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-500">
                        <svg class="flex-shrink-0 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('publications.index') }}" class="ml-4 text-gray-500 hover:text-gray-700 text-sm font-medium">
                        Publicações
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-4 text-gray-500 text-sm font-medium" aria-current="page">
                        {{ $publication->title }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Cabeçalho da publicação -->
        <div class="px-6 py-8 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row items-start lg:items-center mb-6">
                <div class="flex-shrink-0 mr-6 mb-4 lg:mb-0">
                    <div class="w-24 h-32 bg-gray-200 rounded-md border border-gray-300 flex items-center justify-center text-gray-500">
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="flex flex-wrap gap-2 mb-2">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $publication->knowledgeArea->name }}
                        </span>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{ $publication->publicationType->name }}
                        </span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        {{ $publication->title }}
                    </h1>
                    <p class="text-gray-500">Publicado em {{ $publication->publication_date->format('d') }} de 
                        @php
                            $meses = [
                                1 => 'Janeiro',
                                2 => 'Fevereiro',
                                3 => 'Março',
                                4 => 'Abril',
                                5 => 'Maio',
                                6 => 'Junho',
                                7 => 'Julho',
                                8 => 'Agosto',
                                9 => 'Setembro',
                                10 => 'Outubro',
                                11 => 'Novembro',
                                12 => 'Dezembro'
                            ];
                        @endphp
                        {{ $meses[$publication->publication_date->format('n')] }}, {{ $publication->publication_date->format('Y') }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium">
                            {{ substr($publication->user->name, 0, 2) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $publication->user->name }}
                        </p>
                        <div class="flex space-x-1 text-sm text-gray-500">
                            <span>{{ $publication->user->institution }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-sm text-gray-500">{{ $publication->page_count }} páginas</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span class="text-sm text-gray-500">{{ $publication->download_count }} downloads</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="text-sm text-gray-500">{{ $publication->view_count }} visualizações</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumo e Informações -->
        <div class="px-6 py-8 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo</h2>
            <p class="text-gray-700 mb-6">
                {{ $publication->abstract }}
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Informações</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <dl class="space-y-3 text-sm">
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-500">Formato:</dt>
                                <dd class="col-span-2 text-gray-700">{{ strtoupper($publication->file_type) }}</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-500">Tamanho:</dt>
                                <dd class="col-span-2 text-gray-700">{{ number_format($publication->file_size / 1048576, 2) }} MB</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-500">Idioma:</dt>
                                <dd class="col-span-2 text-gray-700">{{ $publication->language }}</dd>
                            </div>
                            @if($publication->issn)
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-500">ISSN:</dt>
                                <dd class="col-span-2 text-gray-700">{{ $publication->issn }}</dd>
                            </div>
                            @endif
                            @if($publication->doi)
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-500">DOI:</dt>
                                <dd class="col-span-2 text-gray-700">{{ $publication->doi }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Palavras-chave</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($publication->keywords as $keyword)
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $keyword->name }}
                        </span>
                        @endforeach
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-3">Citação</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-700">
                            {{ $publication->citation }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview e Download -->
        <div class="px-6 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Preview do Documento</h2>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('publications.download', $publication) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Baixar PDF Completo
                    </a>
                </div>
            </div>

            <div class="border border-gray-300 rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-4 py-3 border-b border-gray-300 flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Preview (primeiras páginas)</span>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="inline-flex items-center p-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <span class="text-sm text-gray-500">1 / 3</span>
                        <button type="button" class="inline-flex items-center p-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="bg-white p-4 flex justify-center">
                    <img src="https://via.placeholder.com/800x1100/f8fafc/64748b?text=Preview+da+Publicação" alt="Preview da publicação" class="max-w-full h-auto border">
                </div>
            </div>
        </div>
    </div>

    @if(isset($relatedPublications) && $relatedPublications->count() > 0)
    <!-- Publicações Relacionadas -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Publicações Relacionadas</h2>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($relatedPublications as $relatedPublication)
            <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $relatedPublication->knowledgeArea->name }}
                        </span>
                    </div>
                    <a href="{{ route('publications.show', $relatedPublication) }}" class="block">
                        <h3 class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition">
                            {{ $relatedPublication->title }}
                        </h3>
                        <p class="mt-3 text-sm text-gray-500 line-clamp-3">
                            {{ $relatedPublication->abstract }}
                        </p>
                    </a>
                    <div class="mt-4 flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium">
                                {{ substr($relatedPublication->user->name, 0, 2) }}
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $relatedPublication->user->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection