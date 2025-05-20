@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(formId) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação não poderá ser revertida!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Minhas Publicações</h1>
            <p class="mt-2 text-gray-600">Gerencie suas publicações acadêmicas</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('publications.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nova Publicação
            </a>
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
                                <div class="ml-3">
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <span>{{ $publication->page_count }} páginas</span>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>{{ strtoupper($publication->file_type) }} ({{ 
                                            $publication->file_size > 1024 * 1024 
                                                ? number_format($publication->file_size / (1024 * 1024), 1) . ' MB'
                                                : number_format($publication->file_size / 1024, 1) . ' KB' 
                                        }})</span>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>{{ $publication->download_count }} downloads</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('publications.edit', $publication) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Editar
                                </a>
                                <form id="delete-form-{{ $publication->id }}" action="{{ route('publications.destroy', $publication) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-form-{{ $publication->id }}')" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Excluir
                                    </button>
                                </form>
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
            <div class="text-center bg-white shadow rounded-lg p-6">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma publicação encontrada</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Você ainda não possui publicações cadastradas.
                </p>
                <div class="mt-6">
                    <a href="{{ route('publications.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Criar primeira publicação
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    <div class="mt-8 flex justify-center">
        {{ $publications->links() }}
    </div>
</div>
@endsection
