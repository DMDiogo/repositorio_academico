<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Repositório Acadêmico') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .btn-primary {
                @apply px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition;
            }
            .btn-secondary {
                @apply px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition;
            }
            .form-input {
                @apply w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">
                                Repositório Acadêmico
                            </a>
                        </div>
                        
                        <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                            <a href="{{ url('/') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 transition">Início</a>
                            <a href="{{ url('/publicacoes') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 transition">Publicações</a>
                            <a href="{{ url('/areas') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 transition">Áreas de Conhecimento</a>
                        </div>
                    </div>
                    
                    <div class="hidden sm:flex sm:items-center">
                        <div class="ml-3 relative">
                            @auth
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none transition">
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    
                                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">
                                        <div class="py-1">
                                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perfil</a>
                                        </div>
                                        <div class="py-1">
                                            <form method="POST" action="{{ url('/logout') }}">
                                                @csrf
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    Sair
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="space-x-2">
                                    <a href="{{ url('/login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md transition">Entrar</a>
                                    <a href="{{ url('/register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition">Registrar</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </nav>
            </div>
            
            <!-- Mobile menu -->
            <div class="sm:hidden hidden mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Início</a>
                    <a href="{{ url('/publicacoes') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Publicações</a>
                    <a href="{{ url('/areas') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Áreas de Conhecimento</a>
                </div>
                
                <div class="pt-4 pb-3 border-t border-gray-200">
                    @auth
                        <div class="px-3 space-y-1">
                            <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Dashboard</a>
                            <a href="{{ url('/profile') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Perfil</a>
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100 text-red-600">Sair</button>
                            </form>
                        </div>
                    @else
                        <div class="px-3 space-y-1">
                            <a href="{{ url('/login') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Entrar</a>
                            <a href="{{ url('/register') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Registrar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-6">
                    <div class="text-center text-sm text-gray-500">
                        <p>&copy; {{ date('Y') }} Repositório Acadêmico. Todos os direitos reservados.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Toggle mobile menu
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html> 