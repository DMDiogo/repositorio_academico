@extends('layouts.app')

@section('content')
<div class="relative">
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                <div>
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                        Repositório Acadêmico Digital
                    </h1>
                    <p class="mt-6 text-xl max-w-3xl">
                        Acesse uma vasta coleção de artigos, publicações e materiais acadêmicos organizados por áreas de conhecimento.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ url('/publicacoes') }}" class="inline-block px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-white hover:bg-gray-100 md:py-4 md:text-lg md:px-10 transition">
                            Explorar Publicações
                        </a>
                        <a href="{{ url('/areas') }}" class="inline-block px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-700 bg-opacity-60 hover:bg-opacity-70 md:py-4 md:text-lg md:px-10 transition">
                            Ver Áreas de Conhecimento
                        </a>
                    </div>
                </div>
                <div class="mt-12 lg:mt-0">
                    <div class="pl-4 sm:pl-6 lg:pl-0">
                        <img class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5" src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Biblioteca digital">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Publicações Recentes -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Publicações Recentes
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Confira os materiais acadêmicos disponíveis para seu curso
                </p>
            </div>

            <div class="mt-12 grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $hasPublicationsForCourse = false;
                @endphp
                
                @forelse($recentPublications as $publication)
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->course === $publication->course))
                        @php
                            $hasPublicationsForCourse = true;
                        @endphp
                        <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $publication->course }}
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-500">
                                            Publicado em {{ $publication->created_at->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('publications.show', $publication) }}" class="block mt-4">
                                    <h3 class="text-xl font-semibold text-gray-900 line-clamp-2">
                                        {{ $publication->title }}
                                    </h3>
                                    <p class="mt-3 text-base text-gray-500 line-clamp-3">
                                        {{ $publication->abstract }}
                                    </p>
                                </a>
                                <div class="mt-6 flex items-center">
                                    <div class="flex-shrink-0">
                                        <span class="sr-only">Autor</span>
                                        <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium">
                                            {{ substr($publication->user->name, 0, 2) }}
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $publication->user->name }}
                                        </p>
                                        <div class="flex space-x-1 text-sm text-gray-500">
                                            <span>{{ $publication->file_type }}</span>
                                            <span aria-hidden="true">&middot;</span>
                                            <span>{{ $publication->page_count }} páginas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Nenhuma publicação disponível no momento.</p>
                    </div>
                @endforelse

                @if(!$hasPublicationsForCourse && count($recentPublications) > 0)
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Ainda não há publicações disponíveis para o curso de <strong>{{ auth()->user()->course }}</strong>.</p>
                        <p class="mt-2 text-sm text-gray-400">Novas publicações serão adicionadas em breve!</p>
                    </div>
                @endif
            </div>

            <div class="mt-12 text-center">
                <a href="{{ url('/publicacoes') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                    Ver todas as publicações do seu curso
                </a>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-blue-600">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Pronto para começar?</span>
                <span class="block text-blue-200">Registre-se gratuitamente hoje.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ url('/register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition">
                        Criar conta
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ url('/login') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-800 hover:bg-blue-700 transition">
                        Entrar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection