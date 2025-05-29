@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Nova Publicação
            </h2>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 divide-y divide-gray-200 p-6">
            @csrf

            <div class="space-y-8 divide-y divide-gray-200">
                <div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Título -->
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <div class="mt-1">
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Resumo -->
                        <div class="sm:col-span-6">
                            <label for="abstract" class="block text-sm font-medium text-gray-700">Resumo</label>
                            <div class="mt-1">
                                <textarea id="abstract" name="abstract" rows="4" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('abstract') }}</textarea>
                            </div>
                            @error('abstract')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Curso -->
                        <div class="sm:col-span-3">
                            <label for="course" class="block text-sm font-medium text-gray-700">Curso</label>
                            <div class="mt-1">
                                <select id="course" name="course" required onchange="updateDisciplines()"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Selecione um curso</option>
                                    <option value="direito">Direito</option>
                                    <option value="sociologia">Sociologia</option>
                                    <option value="filosofia">Filosofia</option>
                                    <option value="psicologia">Psicologia</option>
                                    <option value="ciencias_educacao">Ciências da Educação</option>
                                    <option value="ensino_matematica">Ensino da Matemática</option>
                                    <option value="economia">Economia</option>
                                    <option value="gestao">Gestão / Administração</option>
                                    <option value="contabilidade">Contabilidade e Auditoria</option>
                                    <option value="informatica">Engenharia Informática</option>
                                    <option value="civil">Engenharia Civil</option>
                                    <option value="eletrica">Engenharia Elétrica</option>
                                    <option value="biologia">Biologia</option>
                                    <option value="quimica">Química</option>
                                    <option value="fisica">Física</option>
                                    <option value="medicina">Medicina</option>
                                    <option value="enfermagem">Enfermagem</option>
                                    <option value="farmacia">Farmácia</option>
                                    <option value="agronomia">Engenharia Agronómica</option>
                                    <option value="ambiental">Engenharia Ambiental</option>
                                    <option value="letras">Letras</option>
                                    <option value="comunicacao">Comunicação Social</option>
                                </select>
                            </div>
                        </div>

                        <!-- Disciplina -->
                        <div class="sm:col-span-3">
                            <label for="discipline" class="block text-sm font-medium text-gray-700">Disciplina</label>
                            <div class="mt-1">
                                <select id="discipline" name="discipline" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Selecione primeiro um curso</option>
                                </select>
                            </div>
                        </div>

                        <script>
                            const disciplines = {
                                direito: ['Introdução ao Direito', 'Direito Constitucional', 'Direito Penal', 'Direito Civil', 'Direito Internacional Público e Privado', 'Direito Administrativo', 'Prática Jurídica'],
                                sociologia: ['Introdução à Sociologia', 'Métodos de Pesquisa Social', 'Sociologia da Família', 'Sociologia do Trabalho', 'Antropologia', 'Estatística Social'],
                                filosofia: ['Lógica', 'História da Filosofia', 'Ética e Deontologia', 'Epistemologia', 'Filosofia Africana'],
                                psicologia: ['Psicologia Geral', 'Psicologia do Desenvolvimento', 'Psicologia Clínica', 'Psicometria', 'Psicologia Organizacional'],
                                ciencias_educacao: ['Psicologia Educacional', 'Pedagogia Geral', 'Didáctica Geral', 'Planeamento Educacional', 'Avaliação da Aprendizagem'],
                                ensino_matematica: ['Metodologia de Ensino', 'Didáctica Específica', 'Estágio Pedagógico', 'Avaliação Educacional', 'Currículo e Planeamento'],
                                economia: ['Microeconomia', 'Macroeconomia', 'Economia Monetária', 'Econometria', 'Economia Angolana'],
                                gestao: ['Introdução à Gestão', 'Contabilidade', 'Marketing', 'Recursos Humanos', 'Planeamento Estratégico'],
                                contabilidade: ['Contabilidade Geral', 'Contabilidade de Custos', 'Fiscalidade', 'Auditoria', 'Normas Internacionais de Contabilidade (IFRS)'],
                                informatica: ['Programação', 'Estrutura de Dados', 'Sistemas Operativos', 'Redes de Computadores', 'Bases de Dados', 'Inteligência Artificial', 'Engenharia de Software'],
                                civil: ['Desenho Técnico', 'Mecânica dos Solos', 'Materiais de Construção', 'Estruturas de Betão', 'Hidráulica', 'Topografia'],
                                eletrica: ['Circuitos Eléctricos', 'Máquinas Eléctricas', 'Electrónica Digital e Analógica', 'Instrumentação', 'Sistemas de Controlo'],
                                biologia: ['Botânica', 'Zoologia', 'Genética', 'Ecologia', 'Biologia Molecular'],
                                quimica: ['Química Geral', 'Química Orgânica', 'Química Analítica', 'Bioquímica', 'Físico-Química'],
                                fisica: ['Mecânica', 'Termodinâmica', 'Eletromagnetismo', 'Física Moderna', 'Física Aplicada'],
                                medicina: ['Anatomia', 'Fisiologia', 'Patologia', 'Farmacologia', 'Clínica Médica', 'Saúde Pública'],
                                enfermagem: ['Fundamentos de Enfermagem', 'Enfermagem Médico-Cirúrgica', 'Enfermagem Pediátrica', 'Enfermagem Comunitária', 'Ética e Deontologia em Enfermagem'],
                                farmacia: ['Química Farmacêutica', 'Farmacologia', 'Toxicologia', 'Microbiologia', 'Tecnologia Farmacêutica'],
                                agronomia: ['Solos e Nutrição de Plantas', 'Fitotecnia', 'Zootecnia', 'Mecanização Agrícola', 'Agricultura Sustentável'],
                                ambiental: ['Gestão de Resíduos', 'Avaliação de Impacte Ambiental', 'Ecologia Aplicada', 'Hidrologia', 'Poluição e Tratamento de Águas'],
                                letras: ['Linguística', 'Literatura', 'Fonética e Fonologia', 'Morfossintaxe', 'Tradução e Interpretação'],
                                comunicacao: ['Teorias da Comunicação', 'Técnicas de Redação', 'Jornalismo Digital', 'Rádio e TV', 'Ética e Deontologia da Comunicação']
                            };

                            function updateDisciplines() {
                                const courseSelect = document.getElementById('course');
                                const disciplineSelect = document.getElementById('discipline');
                                const selectedCourse = courseSelect.value;

                                // Clear current options
                                disciplineSelect.innerHTML = '<option value="">Selecione uma disciplina</option>';

                                // Add new options based on selected course
                                if (selectedCourse && disciplines[selectedCourse]) {
                                    disciplines[selectedCourse].forEach(discipline => {
                                        const option = document.createElement('option');
                                        option.value = discipline;
                                        option.textContent = discipline;
                                        disciplineSelect.appendChild(option);
                                    });
                                }
                            }
                        </script>

                        <!-- Tipo de Publicação -->
                        <div class="sm:col-span-3">
                            <label for="publication_type_id" class="block text-sm font-medium text-gray-700">Tipo de Publicação</label>
                            <div class="mt-1">
                                <select id="publication_type_id" name="publication_type_id" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Selecione um tipo</option>
                                    @forelse($publicationTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('publication_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @empty
                                        <option disabled>Nenhum tipo cadastrado</option>
                                    @endforelse
                                </select>
                            </div>
                            @error('publication_type_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Data de Publicação (Hidden) -->
                        <input type="hidden" name="publication_date" id="publication_date" value="{{ date('Y-m-d') }}">

                        <!-- DOI (Hidden) -->
                        <input type="hidden" name="doi" id="doi" value="{{ 'DOI-' . time() . rand(1000,9999) }}">

                        <!-- ISSN (Hidden) -->
                        <input type="hidden" name="issn" id="issn" value="{{ 'ISSN-' . date('Y') . rand(1000,9999) }}">

                        <!-- Idioma -->
                        <div class="sm:col-span-3">
                            <label for="language" class="block text-sm font-medium text-gray-700">Idioma</label>
                            <div class="mt-1">
                                <select id="language" name="language" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="pt-BR" {{ old('language') == 'pt-BR' ? 'selected' : '' }}>Português (Brasil)</option>
                                    <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>English</option>
                                    <option value="es" {{ old('language') == 'es' ? 'selected' : '' }}>Español</option>
                                </select>
                            </div>
                            @error('language')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Arquivo -->
                        <div class="sm:col-span-6">
                            <label for="file" class="block text-sm font-medium text-gray-700">Arquivo (PDF, DOC, DOCX)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload um arquivo</span>
                                            <input id="file" name="file" type="file" class="sr-only" required accept=".pdf,.doc,.docx" onchange="updateFileName(this)">
                                        </label>
                                        <p class="pl-1">ou arraste e solte</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, DOC ou DOCX até 10MB</p>
                                    <!-- Novo elemento para mostrar o arquivo selecionado -->
                                    <div id="selectedFile" class="hidden mt-2">
                                        <p class="text-sm text-gray-600">Arquivo selecionado:</p>
                                        <p id="fileName" class="text-sm font-medium text-blue-600"></p>
                                    </div>
                                </div>
                            </div>
                            @error('file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <a href="{{ route('dashboard') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Criar Publicação
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const selectedFileDiv = document.getElementById('selectedFile');
        const fileNameElement = document.getElementById('fileName');
        
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            fileNameElement.textContent = fileName;
            selectedFileDiv.classList.remove('hidden');
        } else {
            selectedFileDiv.classList.add('hidden');
            fileNameElement.textContent = '';
        }
    }
</script>

@endsection