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

    <!-- Áreas de Conhecimento -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Áreas de Conhecimento
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Navegue por nossas principais áreas de conhecimento e descubra conteúdos relevantes para sua pesquisa acadêmica.
                </p>
            </div>

            <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Área: Ciências Exatas -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Ciências Exatas</h3>
                                <p class="text-base text-gray-500">Matemática, Física, Química</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition">
                                Ver publicações <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Área: Ciências Biológicas -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Ciências Biológicas</h3>
                                <p class="text-base text-gray-500">Biologia, Medicina, Saúde</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition">
                                Ver publicações <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Área: Ciências Humanas -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Ciências Humanas</h3>
                                <p class="text-base text-gray-500">História, Filosofia, Sociologia</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition">
                                Ver publicações <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
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
                    Confira nossos materiais acadêmicos mais recentes
                </p>
            </div>

            <div class="mt-12 grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Publicação 1 -->
                <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    Engenharia
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">
                                    Publicado em 12 de junho, 2023
                                </p>
                            </div>
                        </div>
                        <a href="#" class="block mt-4">
                            <h3 class="text-xl font-semibold text-gray-900 line-clamp-2">
                                Avanços em Inteligência Artificial: aplicações na indústria 4.0
                            </h3>
                            <p class="mt-3 text-base text-gray-500 line-clamp-3">
                                Este artigo discute as aplicações mais recentes de algoritmos de inteligência artificial no contexto da indústria 4.0, com foco em automação e otimização de processos industriais.
                            </p>
                        </a>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="sr-only">Autor</span>
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/42.jpg" alt="">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    Dr. Carlos Silva
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <span>PDF</span>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>32 páginas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publicação 2 -->
                <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Biologia
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">
                                    Publicado em 5 de maio, 2023
                                </p>
                            </div>
                        </div>
                        <a href="#" class="block mt-4">
                            <h3 class="text-xl font-semibold text-gray-900 line-clamp-2">
                                Biodiversidade em ecossistemas marinhos tropicais: um estudo comparativo
                            </h3>
                            <p class="mt-3 text-base text-gray-500 line-clamp-3">
                                Pesquisa sobre a diversidade biológica em diferentes ecossistemas marinhos tropicais, analisando padrões de distribuição e fatores que afetam a biodiversidade.
                            </p>
                        </a>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="sr-only">Autor</span>
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/28.jpg" alt="">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    Dra. Ana Oliveira
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <span>PDF</span>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>45 páginas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publicação 3 -->
                <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    Filosofia
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">
                                    Publicado em 28 de abril, 2023
                                </p>
                            </div>
                        </div>
                        <a href="#" class="block mt-4">
                            <h3 class="text-xl font-semibold text-gray-900 line-clamp-2">
                                Ética na era da inteligência artificial: dilemas contemporâneos
                            </h3>
                            <p class="mt-3 text-base text-gray-500 line-clamp-3">
                                Uma análise filosófica sobre questões éticas surgidas com o avanço da inteligência artificial, abordando temas como privacidade, autonomia e responsabilidade.
                            </p>
                        </a>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="sr-only">Autor</span>
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/35.jpg" alt="">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    Prof. Ricardo Mendes
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <span>PDF</span>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>28 páginas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ url('/publicacoes') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                    Ver todas as publicações
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