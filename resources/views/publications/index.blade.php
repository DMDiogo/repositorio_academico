@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if (session('success'))
        <div class="mb-8 rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Publicações Acadêmicas</h1>
            <p class="mt-2 text-gray-600">Explore nossa coleção de artigos, teses e materiais acadêmicos</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center space-x-4">
            @if(auth()->check() && auth()->user()->user_type === 'teacher')
                <a href="{{ route('publications.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Criar nova publicação
                </a>
            @endif
            <div class="relative rounded-md shadow-sm max-w-xs">
                <input type="text" name="search" id="search" class="block w-full rounded-md border-0 py-3 pl-4 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm" placeholder="Buscar publicações...">
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Área de Conhecimento</label>
                <select id="area" name="area" class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm">
                    <option value="">Todas as áreas</option>
                    @foreach($knowledgeAreas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Publicação</label>
                <select id="tipo" name="tipo" class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm">
                    <option value="">Todos os tipos</option>
                    @foreach($publicationTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="ano" class="block text-sm font-medium text-gray-700 mb-1">Ano de Publicação</label>
                <select id="ano" name="ano" class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm">
                    <option value="">Todos os anos</option>
                    @php
                        $currentYear = date('Y');
                        for($i = $currentYear; $i >= $currentYear - 5; $i--) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                    @endphp
                    <option value="anterior">Anterior a {{ $currentYear - 5 }}</option>
                </select>
            </div>
            <div>
                <label for="ordenar" class="block text-sm font-medium text-gray-700 mb-1">Ordenar por</label>
                <select id="ordenar" name="ordenar" class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm">
                    <option value="recentes">Mais recentes</option>
                    <option value="antigos">Mais antigos</option>
                    <option value="downloads">Mais baixados</option>
                    <option value="alfabetica">Ordem alfabética</option>
                </select>
            </div>
        </div>
        <div class="mt-4 flex justify-end">
            <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Aplicar Filtros
            </button>
        </div>
    </div>

    <!-- Lista de Publicações -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($publications as $publication)
        <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row">
                    <div class="flex-shrink-0 mr-6 mb-4 lg:mb-0">
                        <div class="w-24 h-32 bg-gray-200 rounded-md border border-gray-300 flex items-center justify-center text-gray-500">
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $publication->knowledgeArea->name }}
                            </span>
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                {{ $publication->publicationType->name }}
                            </span>
                            <span class="text-sm text-gray-500">{{ $publication->publication_date->format('F Y') }}</span>
                        </div>
                        <a href="{{ route('publications.show', $publication) }}" class="block">
                            <h3 class="text-xl font-semibold text-gray-900 hover:text-blue-600 transition">
                                {{ $publication->title }}
                            </h3>
                            <p class="mt-3 text-gray-500">
                                {{ Str::limit($publication->abstract, 200) }}
                            </p>
                        </a>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium">
                                        @php
                                            $nameParts = explode(' ', $publication->user->name);
                                            $initials = strtoupper(substr($nameParts[0], 0, 1));
                                            if (count($nameParts) > 1) {
                                                $initials .= strtoupper(substr($nameParts[1], 0, 1));
                                            }
                                            echo $initials;
                                        @endphp
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $publication->user->name }}
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <span>{{ $publication->page_count }} páginas</span>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>{{ strtoupper($publication->file_type) }} ({{ 
                                            $publication->file_size > 1024 * 1024 
                                                ? number_format($publication->file_size / (1024 * 1024), 1) . ' MB'
                                                : number_format($publication->file_size / 1024, 1) . ' KB' 
                                        }})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    {{ $publication->download_count }} downloads
                                </span>
                                <a href="{{ route('publications.download', $publication) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Baixar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma publicação encontrada</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Ainda não há publicações cadastradas no sistema.
                    </p>
                    @if(auth()->check() && auth()->user()->role === 'professor')
                        <div class="mt-6">
                            <a href="{{ route('publications.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Criar nova publicação
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endforelse

        <!-- Paginação -->
        <div class="mt-8 flex justify-center">
            {{ $publications->links() }}
        </div>
    </div>
</div>
@endsection