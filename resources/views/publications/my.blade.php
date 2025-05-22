@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Minhas Publicações</h2>
                    <a href="{{ route('publications.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Nova Publicação
                    </a>
                </div>

                @if($publications->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">Você ainda não tem publicações.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-6">
                        @foreach($publications as $publication)
                            <div class="border rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $publication->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            @if($publication->publicationType)
                                                {{ $publication->publicationType->name }}
                                            @else
                                                Tipo não definido
                                            @endif
                                        </p>
                                        <p class="text-sm text-gray-500 mt-2">{{ Str::limit($publication->abstract, 200) }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('publications.edit', $publication->id) }}" class="text-blue-600 hover:text-blue-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-4 text-sm text-gray-500">
                                    <p>Data de publicação: {{ \Carbon\Carbon::parse($publication->publication_date)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $publications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
