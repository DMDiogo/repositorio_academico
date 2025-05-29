@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- Cabeçalho do perfil -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6 text-white">
                <div class="flex items-center">
                    <div class="h-24 w-24 rounded-full bg-white text-blue-700 flex items-center justify-center text-3xl font-bold shadow-lg border-4 border-white">
                        @php
                            $nameParts = explode(' ', $user->name);
                            $initials = strtoupper(substr($nameParts[0], 0, 1));
                            if (count($nameParts) > 1) {
                                $initials .= strtoupper(substr($nameParts[1], 0, 1));
                            }
                            echo $initials;
                        @endphp
                    </div>
                    <div class="ml-6">
                        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                        <p class="text-blue-100">Membro desde {{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Formulário de edição -->
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Editar Usuário</h2>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informações pessoais -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-700 mb-4">Dados Pessoais</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="user_type" class="block text-sm font-medium text-gray-700">Tipo de Usuário</label>
                                    <select name="user_type" id="user_type" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="admin" {{ $user->user_type === 'admin' ? 'selected' : '' }}>Administrador</option>
                                        <option value="teacher" {{ $user->user_type === 'teacher' ? 'selected' : '' }}>Professor</option>
                                        <option value="student" {{ $user->user_type === 'student' ? 'selected' : '' }}>Aluno</option>
                                    </select>
                                </div>

                                @if($user->user_type === 'student')
                                <div>
                                    <label for="course" class="block text-sm font-medium text-gray-700">Curso</label>
                                    <input type="text" name="course" id="course" value="{{ old('course', $user->course) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Informações adicionais -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-700 mb-4">Informações Adicionais</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="institution" class="block text-sm font-medium text-gray-700">Instituição</label>
                                    <input type="text" name="institution" id="institution" value="{{ old('institution', $user->institution) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="academic_title" class="block text-sm font-medium text-gray-700">Título Acadêmico</label>
                                    <input type="text" name="academic_title" id="academic_title" value="{{ old('academic_title', $user->academic_title) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="department" class="block text-sm font-medium text-gray-700">Departamento</label>
                                    <input type="text" name="department" id="department" value="{{ old('department', $user->department) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="orcid" class="block text-sm font-medium text-gray-700">ORCID</label>
                                    <input type="text" name="orcid" id="orcid" value="{{ old('orcid', $user->orcid) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de ação -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('users.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 