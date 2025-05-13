@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Áreas de Conhecimento</h1>
        <p class="mt-2 text-gray-600">Explore publicações por área de conhecimento</p>
    </div>

    <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <!-- Área: Ciências Exatas -->
        <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Ciências Exatas" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900 to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h2 class="text-2xl font-bold text-white">Ciências Exatas</h2>
                    <p class="text-blue-100">124 publicações</p>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">
                    Ciências que estudam fenômenos quantificáveis por meio de modelos matemáticos. Incluem matemática, física, química e estatística.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Matemática
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Física
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Química
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Estatística
                    </span>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                    Ver publicações
                    <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Área: Ciências Biológicas -->
        <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1597852074816-d933c7d2b988?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Ciências Biológicas" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-green-900 to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h2 class="text-2xl font-bold text-white">Ciências Biológicas</h2>
                    <p class="text-green-100">156 publicações</p>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">
                    Ciências que estudam os seres vivos, suas características, comportamentos e interações. Incluem biologia, medicina, saúde e ecologia.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Biologia
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Medicina
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Ecologia
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Genética
                    </span>
                </div>
                <a href="#" class="text-green-600 hover:text-green-800 font-medium inline-flex items-center">
                    Ver publicações
                    <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Área: Ciências Humanas -->
        <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1544383835-bda2bc66a55d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Ciências Humanas" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-purple-900 to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h2 class="text-2xl font-bold text-white">Ciências Humanas</h2>
                    <p class="text-purple-100">185 publicações</p>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">
                    Ciências que estudam o ser humano e suas relações sociais, culturais e históricas. Incluem história, filosofia, sociologia e antropologia.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        História
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        Filosofia
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        Sociologia
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        Antropologia
                    </span>
                </div>
                <a href="#" class="text-purple-600 hover:text-purple-800 font-medium inline-flex items-center">
                    Ver publicações
                    <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Área: Ciências Sociais Aplicadas -->
        <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Ciências Sociais Aplicadas" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-900 to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h2 class="text-2xl font-bold text-white">Ciências Sociais Aplicadas</h2>
                    <p class="text-yellow-100">132 publicações</p>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">
                    Ciências que aplicam conhecimentos teóricos em áreas práticas relacionadas à sociedade. Incluem direito, economia, administração e comunicação.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Direito
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Economia
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Administração
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Comunicação
                    </span>
                </div>
                <a href="#" class="text-yellow-600 hover:text-yellow-800 font-medium inline-flex items-center">
                    Ver publicações
                    <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Área: Engenharias -->
        <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Engenharias" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-red-900 to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h2 class="text-2xl font-bold text-white">Engenharias</h2>
                    <p class="text-red-100">167 publicações</p>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">
                    Áreas do conhecimento que aplicam princípios científicos para desenvolver soluções técnicas. Incluem engenharia civil, elétrica, mecânica e de computação.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Engenharia Civil
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Engenharia Elétrica
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Engenharia Mecânica
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Computação
                    </span>
                </div>
                <a href="#" class="text-red-600 hover:text-red-800 font-medium inline-flex items-center">
                    Ver publicações
                    <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Área: Linguística, Letras e Artes -->
        <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1519791883288-dc8bd696e667?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Linguística, Letras e Artes" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-900 to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h2 class="text-2xl font-bold text-white">Linguística, Letras e Artes</h2>
                    <p class="text-indigo-100">94 publicações</p>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">
                    Áreas que estudam a linguagem, a literatura e as expressões artísticas. Incluem linguística, literatura, música e artes visuais.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Linguística
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Literatura
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Música
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Artes Visuais
                    </span>
                </div>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center">
                    Ver publicações
                    <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Estatísticas -->
    <div class="mt-16 bg-white shadow rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Estatísticas por Área</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Publicações por Área</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Ciências Humanas</span>
                            <span class="text-sm font-medium text-gray-900">185</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 28%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Engenharias</span>
                            <span class="text-sm font-medium text-gray-900">167</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-600 h-2 rounded-full" style="width: 25%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Ciências Biológicas</span>
                            <span class="text-sm font-medium text-gray-900">156</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 23%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Ciências Sociais Aplicadas</span>
                            <span class="text-sm font-medium text-gray-900">132</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-600 h-2 rounded-full" style="width: 20%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Ciências Exatas</span>
                            <span class="text-sm font-medium text-gray-900">124</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 19%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Linguística, Letras e Artes</span>
                            <span class="text-sm font-medium text-gray-900">94</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full" style="width: 14%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Downloads por Área</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Engenharias</span>
                            <span class="text-sm font-medium text-gray-900">4,256</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-600 h-2 rounded-full" style="width: 32%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Ciências Biológicas</span>
                            <span class="text-sm font-medium text-gray-900">3,789</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 29%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Ciências Humanas</span>
                            <span class="text-sm font-medium text-gray-900">2,983</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 22%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Ciências Sociais Aplicadas</span>
                            <span class="text-sm font-medium text-gray-900">2,145</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-600 h-2 rounded-full" style="width: 16%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Ciências Exatas</span>
                            <span class="text-sm font-medium text-gray-900">1,876</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 14%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Linguística, Letras e Artes</span>
                            <span class="text-sm font-medium text-gray-900">951</span>
                        </div>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full" style="width: 7%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 