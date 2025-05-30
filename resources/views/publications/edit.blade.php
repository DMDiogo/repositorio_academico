@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Editar Publicação
            </h2>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('publications.update', $publication) }}" method="POST" enctype="multipart/form-data" class="space-y-8 divide-y divide-gray-200 p-6">
            @csrf
            @method('PUT')

            <div class="space-y-8 divide-y divide-gray-200">
                <div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Título -->
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <div class="mt-1">
                                <input type="text" name="title" id="title" value="{{ old('title', $publication->title) }}" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Resumo -->
                        <div class="sm:col-span-6">
                            <label for="abstract" class="block text-sm font-medium text-gray-700">Resumo</label>
                            <div class="mt-1">
                                <textarea id="abstract" name="abstract" rows="4" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('abstract', $publication->abstract) }}</textarea>
                            </div>
                            @error('abstract')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Área do Conhecimento -->
                        <div class="sm:col-span-3">
                            <label for="knowledge_area_id" class="block text-sm font-medium text-gray-700">Área do Conhecimento</label>
                            <div class="mt-1">
                                <select id="knowledge_area_id" name="knowledge_area_id" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Selecione uma área</option>
                                    @foreach($knowledgeAreas as $area)
                                        <option value="{{ $area->id }}" {{ old('knowledge_area_id', $publication->knowledge_area_id) == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('knowledge_area_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipo de Publicação -->
                        <div class="sm:col-span-3">
                            <label for="publication_type_id" class="block text-sm font-medium text-gray-700">Tipo de Publicação</label>
                            <div class="mt-1">
                                <select id="publication_type_id" name="publication_type_id" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Selecione um tipo</option>
                                    @foreach($publicationTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('publication_type_id', $publication->publication_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('publication_type_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Data de Publicação -->
                        <div class="sm:col-span-3">
                            <label for="publication_date" class="block text-sm font-medium text-gray-700">
                                Data de Publicação
                                <svg class="inline-block h-4 w-4 text-gray-400 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </label>
                            <div class="mt-1">
                                <input type="date" name="publication_date" id="publication_date" 
                                    value="{{ old('publication_date', $publication->publication_date->format('Y-m-d')) }}" readonly
                                    class="shadow-sm bg-gray-100 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Número de Páginas -->
                        <div class="sm:col-span-3">
                            <label for="page_count" class="block text-sm font-medium text-gray-700">
                                Número de Páginas
                                <svg class="inline-block h-4 w-4 text-gray-400 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </label>
                            <div class="mt-1">
                                <input type="number" name="page_count" id="page_count" 
                                    value="{{ old('page_count', $publication->page_count) }}" readonly
                                    class="shadow-sm bg-gray-100 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Idioma -->
                        <div class="sm:col-span-3">
                            <label for="language" class="block text-sm font-medium text-gray-700">Idioma</label>
                            <div class="mt-1">
                                <select id="language" name="language" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="pt-BR" {{ old('language', $publication->language) == 'pt-BR' ? 'selected' : '' }}>Português (Brasil)</option>
                                    <option value="en" {{ old('language', $publication->language) == 'en' ? 'selected' : '' }}>English</option>
                                    <option value="es" {{ old('language', $publication->language) == 'es' ? 'selected' : '' }}>Español</option>
                                </select>
                            </div>
                            @error('language')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- DOI -->
                        <div class="sm:col-span-3">
                            <label for="doi" class="block text-sm font-medium text-gray-700">
                                DOI
                                <svg class="inline-block h-4 w-4 text-gray-400 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </label>
                            <div class="mt-1">
                                <input type="text" name="doi" id="doi" value="{{ old('doi', $publication->doi) }}" readonly
                                    class="shadow-sm bg-gray-100 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- ISSN -->
                        <div class="sm:col-span-3">
                            <label for="issn" class="block text-sm font-medium text-gray-700">
                                ISSN
                                <svg class="inline-block h-4 w-4 text-gray-400 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </label>
                            <div class="mt-1">
                                <input type="text" name="issn" id="issn" value="{{ old('issn', $publication->issn) }}" readonly
                                    class="shadow-sm bg-gray-100 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Arquivo -->
                        <div class="sm:col-span-6">
                            <label for="file" class="block text-sm font-medium text-gray-700">Arquivo (PDF, DOC, DOCX)</label>
                            <div class="mt-1">
                                <p class="text-sm text-gray-500 mb-2">Arquivo atual: {{ basename($publication->file_path) }}</p>
                                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload um novo arquivo</span>
                                                <input id="file" name="file" type="file" class="sr-only" accept=".pdf,.doc,.docx">
                                            </label>
                                            <p class="pl-1">ou arraste e solte</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF, DOC ou DOCX até 10MB</p>
                                    </div>
                                </div>
                            </div>
                            @error('file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <a href="{{ route('my-publications') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Salvar Alterações
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
