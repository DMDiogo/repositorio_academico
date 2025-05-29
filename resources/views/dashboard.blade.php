@extends('layouts.app')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmReject(form) {
        event.preventDefault();
        Swal.fire({
            title: 'Tem certeza?',
            text: "Esta ação não poderá ser revertida!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sim, rejeitar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endpush

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif

        <div class="bg-white shadow sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Perfil</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Olá {{ Auth::user()->name }}, bem-vindo ao seu painel do Repositório Acadêmico.
                        </p>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                            @if(Auth::user()->isAdmin())
                                bg-red-100 text-red-800
                            @elseif(Auth::user()->isTeacher())
                                bg-purple-100 text-purple-800
                            @else
                                bg-blue-100 text-blue-800
                            @endif">
                            @if(Auth::user()->isAdmin())
                                Administrador
                            @elseif(Auth::user()->isTeacher())
                                Professor
                            @else
                                Aluno
                            @endif
                        </span>
                    </div>
                </div>

                @if(Auth::user()->isAdmin())
                <!-- Ações Rápidas para Administradores -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Ações Rápidas</h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <a href="{{ route('users.index') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-900">Gerenciar Usuários</span>
                            <span class="mt-1 block text-sm text-gray-500">Gerencie usuários e permissões</span>
                        </a>

                        <a href="{{ route('publications.index') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2-0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-900">Gerenciar Publicações</span>
                            <span class="mt-1 block text-sm text-gray-500">Gerencie todas as publicações</span>
                        </a>

                        <a href="{{ route('admin.statistics') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-900">Estatísticas do Sistema</span>
                            <span class="mt-1 block text-sm text-gray-500">Visualize métricas do sistema</span>
                        </a>
                    </div>
                </div>
                @elseif(Auth::user()->isTeacher())
                <!-- Ações Rápidas para Professores -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Ações Rápidas</h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <a href="{{ route('publications.create') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-900">Nova Publicação</span>
                            <span class="mt-1 block text-sm text-gray-500">Adicione um novo artigo, tese ou livro</span>
                        </a>

                        <a href="{{ route('my-publications') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2-0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-900">Minhas Publicações</span>
                            <span class="mt-1 block text-sm text-gray-500">Ver minhas publicações</span>
                        </a>

                        <a href="{{ route('teacher.statistics') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-900">Estatísticas</span>
                            <span class="mt-1 block text-sm text-gray-500">Visualize métricas e downloads</span>
                        </a>
                    </div>
                </div>
                @endif
                
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Estatísticas do Usuário -->
                    <div class="bg-blue-50 overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            @if(Auth::user()->isAdmin())
                                                Total de Publicações
                                            @elseif(Auth::user()->isTeacher())
                                                Suas Publicações
                                            @else
                                                Publicações do seu Curso
                                            @endif
                                        </dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-gray-900">
                                                {{ Auth::user()->isAdmin() ? \App\Models\Publication::count() : 
                                                   (Auth::user()->isTeacher() ? Auth::user()->publications()->count() : 
                                                   \App\Models\Publication::where('course', Auth::user()->course)->count()) }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-blue-100 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ route('publications.index', ['course' => Auth::user()->isStudent() ? Auth::user()->course : null]) }}" 
                                   class="font-medium text-blue-700 hover:text-blue-900">
                                    @if(Auth::user()->isStudent())
                                        Ver publicações de {{ Auth::user()->course }}
                                    @else
                                        Ver todas as publicações
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Downloads -->
                    <div class="bg-green-50 overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            @if(Auth::user()->isAdmin())
                                                Total de Usuários
                                            @elseif(Auth::user()->isTeacher())
                                                Downloads das suas Publicações
                                            @else
                                                Seus Downloads
                                            @endif
                                        </dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-gray-900">
                                                @if(Auth::user()->isAdmin())
                                                    {{ \App\Models\User::where('approval_status', '!=', 'rejected')->count() }}
                                                @elseif(Auth::user()->isTeacher())
                                                    {{ \App\Models\Download::whereIn('publication_id', Auth::user()->publications->pluck('id'))->count() }}
                                                @else
                                                    {{ \App\Models\Download::where('user_id', Auth::user()->id)->count() }}
                                                @endif
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-100 px-5 py-3">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-green-700 hover:text-green-900">
                                    @if(Auth::user()->isAdmin())
                                        Ver todos os usuários
                                    @elseif(Auth::user()->isTeacher())
                                        Ver histórico de downloads
                                    @else
                                        Ver seus downloads
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Perfil -->
                    <div class="bg-purple-50 overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Seu Perfil
                                        </dt>
                                        <dd class="flex flex-col">
                                            <div class="text-lg font-semibold text-gray-900 truncate">
                                                {{ Auth::user()->email }}
                                            </div>
                                            <div class="mt-1 text-sm text-gray-600">
                                                @if(Auth::user()->isAdmin())
                                                    Administrador
                                                @elseif(Auth::user()->isTeacher())
                                                    Professor
                                                @else
                                                    Aluno
                                                @endif
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-purple-100 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ url('/profile') }}" class="font-medium text-purple-700 hover:text-purple-900">
                                    Editar perfil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if(Auth::user()->isAdmin() && $pendingUsers->count() > 0)
                <!-- Solicitações de Aprovação -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Solicitações de Aprovação</h3>
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul class="divide-y divide-gray-200">
                            @foreach($pendingUsers as $user)
                            <li class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $user->email }} - {{ $user->user_type === 'teacher' ? 'Professor' : 'Aluno' }}
                                        </p>
                                        @if($user->institution)
                                        <p class="text-sm text-gray-500">
                                            Instituição: {{ $user->institution }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-shrink-0 flex space-x-2">
                                        <form action="{{ route('users.approve', $user) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                Aprovar
                                            </button>
                                        </form>
                                        <form action="{{ route('users.reject', $user) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Rejeitar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Atividades Recentes -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Atividades Recentes</h3>
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul class="divide-y divide-gray-200">
                            <li class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            Bem-vindo ao Repositório Acadêmico
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            @if(Auth::user()->isAdmin())
                                                Você está logado como administrador. Gerencie usuários, publicações e monitore as atividades do sistema.
                                            @elseif(Auth::user()->isTeacher())
                                                Você criou sua conta com sucesso como professor. Comece adicionando suas publicações acadêmicas para compartilhar com a comunidade.
                                            @else
                                                Você criou sua conta com sucesso como aluno. Explore as publicações acadêmicas disponíveis.
                                            @endif
                                        </p>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Novo
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection