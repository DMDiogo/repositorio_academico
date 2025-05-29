@extends('layouts.guest')

@section('content')
<div class="py-16 bg-gray-50">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
            <div class="p-8">
                <h2 class="text-2xl font-bold mb-8 text-gray-800">Criar Conta</h2>
                
                <!-- Mensagens de erro -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                        <p class="font-medium">Ops! Algo deu errado.</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ url('/register') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm" 
                                placeholder="Seu nome completo"
                                required 
                                autofocus
                            >
                        </div>
                    </div>
                    
                    <!-- User Type -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Usuário</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="relative">
                                <input 
                                    id="user_type_student" 
                                    type="radio" 
                                    name="user_type" 
                                    value="student"
                                    {{ old('user_type', 'student') === 'student' ? 'checked' : '' }}
                                    class="peer sr-only"
                                    required
                                >
                                <label 
                                    for="user_type_student" 
                                    class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50 transition duration-150 ease-in-out"
                                >
                                    <svg class="w-8 h-8 mb-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-900">Aluno</span>
                                </label>
                            </div>
                            <div class="relative">
                                <input 
                                    id="user_type_teacher" 
                                    type="radio" 
                                    name="user_type" 
                                    value="teacher"
                                    {{ old('user_type') === 'teacher' ? 'checked' : '' }}
                                    class="peer sr-only"
                                    required
                                >
                                <label 
                                    for="user_type_teacher" 
                                    class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50 transition duration-150 ease-in-out"
                                >
                                    <svg class="w-8 h-8 mb-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-900">Professor</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Course Selection (for students) -->
                    <div id="courseSelection" class="hidden">
                        <label for="course" class="block text-sm font-semibold text-gray-700 mb-2">Curso</label>
                        <select
                            id="course"
                            name="course"
                            class="block w-full pl-3 pr-10 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm"
                        >
                            <option value="">Selecione seu curso</option>
                            @php
                                $courses = [
                                    'Direito', 'Sociologia', 'Filosofia', 'Psicologia', 'Ciências da Educação',
                                    'Ensino da Matemática', 'Ensino da Biologia', 'Ensino da Física', 'Ensino da Química',
                                    'Ensino das Línguas', 'Economia', 'Gestão', 'Administração', 'Contabilidade e Auditoria',
                                    'Finanças', 'Marketing', 'Engenharia Informática', 'Ciências da Computação',
                                    'Engenharia Civil', 'Engenharia Eléctrica', 'Engenharia Electrónica',
                                    'Engenharia de Telecomunicações', 'Engenharia Mecânica', 'Biologia', 'Química',
                                    'Física', 'Geologia', 'Medicina', 'Enfermagem', 'Farmácia', 'Análises Clínicas',
                                    'Saúde Pública', 'Engenharia Agronómica', 'Engenharia Florestal', 'Engenharia Ambiental',
                                    'Zootecnia', 'Letras', 'Comunicação Social', 'Jornalismo', 'Tradução e Interpretação',
                                    'História', 'Geografia'
                                ];
                            @endphp
                            @foreach($courses as $courseOption)
                                <option value="{{ $courseOption }}" {{ old('course') === $courseOption ? 'selected' : '' }}>
                                    {{ $courseOption }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">E-mail</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm" 
                                placeholder="seu@email.com"
                                required
                            >
                        </div>
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Senha</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm" 
                                placeholder="Mínimo 8 caracteres"
                                required
                            >
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Use pelo menos 8 caracteres com letras, números e símbolos</p>
                    </div>
                    
                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirmar Senha</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                name="password_confirmation" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm" 
                                placeholder="Digite a senha novamente"
                                required
                            >
                        </div>
                    </div>
                    
                    <!-- Terms -->
                    <div class="flex items-center">
                        <input 
                            id="terms" 
                            type="checkbox" 
                            name="terms" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition duration-150 ease-in-out"
                            required
                        >
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            Eu concordo com os <a href="#" class="text-blue-600 hover:text-blue-800">Termos de Serviço</a> e <a href="#" class="text-blue-600 hover:text-blue-800">Política de Privacidade</a>
                        </label>
                    </div>
                    
                    <div>
                        <button 
                            type="submit" 
                            class="w-full px-5 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out shadow-sm"
                        >
                            Criar Conta
                        </button>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const studentRadio = document.getElementById('user_type_student');
    const teacherRadio = document.getElementById('user_type_teacher');
    const courseSelection = document.getElementById('courseSelection');
    const courseInput = document.getElementById('course');

    function toggleCourseSelection() {
        if (studentRadio.checked) {
            courseSelection.classList.remove('hidden');
            courseInput.required = true;
        } else {
            courseSelection.classList.add('hidden');
            courseInput.required = false;
        }
    }

    studentRadio.addEventListener('change', toggleCourseSelection);
    teacherRadio.addEventListener('change', toggleCourseSelection);
    
    // Initial check
    toggleCourseSelection();
});
</script>
@endsection