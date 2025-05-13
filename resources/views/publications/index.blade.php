@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Publicações Acadêmicas</h1>
            <p class="mt-2 text-gray-600">Explore nossa coleção de artigos, teses e materiais acadêmicos</p>
        </div>
        <div class="mt-4 md:mt-0">
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
                    <option value="exatas">Ciências Exatas</option>
                    <option value="biologicas">Ciências Biológicas</option>
                    <option value="humanas">Ciências Humanas</option>
                    <option value="sociais">Ciências Sociais Aplicadas</option>
                    <option value="engenharias">Engenharias</option>
                    <option value="linguistica">Linguística, Letras e Artes</option>
                </select>
            </div>
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Publicação</label>
                <select id="tipo" name="tipo" class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm">
                    <option value="">Todos os tipos</option>
                    <option value="artigo">Artigo Científico</option>
                    <option value="tese">Tese</option>
                    <option value="dissertacao">Dissertação</option>
                    <option value="monografia">Monografia</option>
                    <option value="livro">Livro</option>
                </select>
            </div>
            <div>
                <label for="ano" class="block text-sm font-medium text-gray-700 mb-1">Ano de Publicação</label>
                <select id="ano" name="ano" class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm">
                    <option value="">Todos os anos</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="anterior">Anterior a 2019</option>
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
        <!-- Publicação 1 -->
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
                                Engenharia
                            </span>
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Artigo Científico
                            </span>
                            <span class="text-sm text-gray-500">Junho 2023</span>
                        </div>
                        <a href="{{ url('/publicacoes/1') }}" class="block">
                            <h3 class="text-xl font-semibold text-gray-900 hover:text-blue-600 transition">
                                Avanços em Inteligência Artificial: aplicações na indústria 4.0
                            </h3>
                            <p class="mt-3 text-gray-500">
                                Este artigo discute as aplicações mais recentes de algoritmos de inteligência artificial no contexto da indústria 4.0, com foco em automação e otimização de processos industriais.
                            </p>
                        </a>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/42.jpg" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        Dr. Carlos Silva
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <span>32 páginas</span>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>PDF (2.4 MB)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    187 downloads
                                </span>
                                <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Baixar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publicação 2 -->
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
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Biologia
                            </span>
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Dissertação
                            </span>
                            <span class="text-sm text-gray-500">Maio 2023</span>
                        </div>
                        <a href="{{ url('/publicacoes/2') }}" class="block">
                            <h3 class="text-xl font-semibold text-gray-900 hover:text-blue-600 transition">
                                Biodiversidade em ecossistemas marinhos tropicais: um estudo comparativo
                            </h3>
                            <p class="mt-3 text-gray-500">
                                Pesquisa sobre a diversidade biológica em diferentes ecossistemas marinhos tropicais, analisando padrões de distribuição e fatores que afetam a biodiversidade.
                            </p>
                        </a>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/28.jpg" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        Dra. Ana Oliveira
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <span>45 páginas</span>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>PDF (3.8 MB)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    246 downloads
                                </span>
                                <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Baixar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publicação 3 -->
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
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                Filosofia
                            </span>
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Artigo Científico
                            </span>
                            <span class="text-sm text-gray-500">Abril 2023</span>
                        </div>
                        <a href="#" class="block">
                            <h3 class="text-xl font-semibold text-gray-900 hover:text-blue-600 transition">
                                Ética na era da inteligência artificial: dilemas contemporâneos
                            </h3>
                            <p class="mt-3 text-gray-500">
                                Uma análise filosófica sobre questões éticas surgidas com o avanço da inteligência artificial, abordando temas como privacidade, autonomia e responsabilidade.
                            </p>
                        </a>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/35.jpg" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        Prof. Ricardo Mendes
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <span>28 páginas</span>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>PDF (1.7 MB)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    124 downloads
                                </span>
                                <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Baixar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publicação 4 -->
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
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                Economia
                            </span>
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Tese
                            </span>
                            <span class="text-sm text-gray-500">Março 2023</span>
                        </div>
                        <a href="#" class="block">
                            <h3 class="text-xl font-semibold text-gray-900 hover:text-blue-600 transition">
                                Impactos econômicos da transição energética: desafios e oportunidades para economias emergentes
                            </h3>
                            <p class="mt-3 text-gray-500">
                                Análise dos desafios e oportunidades econômicas enfrentados por países em desenvolvimento durante a transição para fontes de energia renovável, considerando aspectos como investimentos, empregos e competitividade internacional.
                            </p>
                        </a>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/42.jpg" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        Dra. Juliana Santos
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <span>112 páginas</span>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>PDF (5.2 MB)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    98 downloads
                                </span>
                                <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Baixar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginação -->
    <div class="mt-8 flex justify-center">
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Paginação">
            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Anterior</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
            <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                1
            </a>
            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                2
            </a>
            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                3
            </a>
            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                ...
            </span>
            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                8
            </a>
            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                9
            </a>
            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                10
            </a>
            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Próxima</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </nav>
    </div>

</div>
@endsection 