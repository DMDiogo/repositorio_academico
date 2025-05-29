@extends('layouts.app')

@section('content')
@php
    $courseDisciplines = [
        'Direito' => ['Introdução ao Direito', 'Direito Constitucional', 'Direito Penal', 'Direito Civil', 'Direito Internacional Público e Privado', 'Direito Administrativo', 'Prática Jurídica'],
        'Sociologia' => ['Introdução à Sociologia', 'Métodos de Pesquisa Social', 'Sociologia da Família', 'Sociologia do Trabalho', 'Antropologia', 'Estatística Social'],
        'Filosofia' => ['Lógica', 'História da Filosofia', 'Ética e Deontologia', 'Epistemologia', 'Filosofia Africana'],
        'Psicologia' => ['Psicologia Geral', 'Psicologia do Desenvolvimento', 'Psicologia Clínica', 'Psicometria', 'Psicologia Organizacional'],
        'Ciências da Educação' => ['Psicologia Educacional', 'Pedagogia Geral', 'Didáctica Geral', 'Planeamento Educacional', 'Avaliação da Aprendizagem'],
        'Ensino da Matemática' => ['Metodologia de Ensino', 'Didáctica Específica', 'Estágio Pedagógico', 'Avaliação Educacional', 'Currículo e Planeamento'],
        'Economia' => ['Microeconomia', 'Macroeconomia', 'Economia Monetária', 'Econometria', 'Economia Angolana'],
        'Gestão' => ['Introdução à Gestão', 'Contabilidade', 'Marketing', 'Recursos Humanos', 'Planeamento Estratégico'],
        'Contabilidade' => ['Contabilidade Geral', 'Contabilidade de Custos', 'Fiscalidade', 'Auditoria', 'Normas Internacionais de Contabilidade (IFRS)'],
        'Engenharia Informática' => ['Programação', 'Estrutura de Dados', 'Sistemas Operativos', 'Redes de Computadores', 'Bases de Dados', 'Inteligência Artificial', 'Engenharia de Software'],
        'Engenharia Civil' => ['Desenho Técnico', 'Mecânica dos Solos', 'Materiais de Construção', 'Estruturas de Betão', 'Hidráulica', 'Topografia'],
        'Engenharia Elétrica' => ['Circuitos Eléctricos', 'Máquinas Eléctricas', 'Electrónica Digital e Analógica', 'Instrumentação', 'Sistemas de Controlo'],
        'Biologia' => ['Botânica', 'Zoologia', 'Genética', 'Ecologia', 'Biologia Molecular'],
        'Química' => ['Química Geral', 'Química Orgânica', 'Química Analítica', 'Bioquímica', 'Físico-Química'],
        'Física' => ['Mecânica', 'Termodinâmica', 'Eletromagnetismo', 'Física Moderna', 'Física Aplicada'],
        'Medicina' => ['Anatomia', 'Fisiologia', 'Patologia', 'Farmacologia', 'Clínica Médica', 'Saúde Pública'],
        'Enfermagem' => ['Fundamentos de Enfermagem', 'Enfermagem Médico-Cirúrgica', 'Enfermagem Pediátrica', 'Enfermagem Comunitária', 'Ética e Deontologia em Enfermagem'],
        'Farmácia' => ['Química Farmacêutica', 'Farmacologia', 'Toxicologia', 'Microbiologia', 'Tecnologia Farmacêutica'],
        'Engenharia Agronómica' => ['Solos e Nutrição de Plantas', 'Fitotecnia', 'Zootecnia', 'Mecanização Agrícola', 'Agricultura Sustentável'],
        'Engenharia Ambiental' => ['Gestão de Resíduos', 'Avaliação de Impacte Ambiental', 'Ecologia Aplicada', 'Hidrologia', 'Poluição e Tratamento de Águas'],
        'Letras' => ['Linguística', 'Literatura', 'Fonética e Fonologia', 'Morfossintaxe', 'Tradução e Interpretação'],
        'Comunicação Social' => ['Teorias da Comunicação', 'Técnicas de Redação', 'Jornalismo Digital', 'Rádio e TV', 'Ética e Deontologia da Comunicação']
    ];

    // Array com imagens temáticas para cada área
    $disciplineImages = [
        'Direito Constitucional' => 'https://images.unsplash.com/photo-1589994965851-a8f479c573a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Direito Penal' => 'https://images.unsplash.com/photo-1453945619913-79ec89a82c51?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Sociologia' => 'https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Anatomia' => 'https://images.unsplash.com/photo-1576086213369-97a306d36557?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Enfermagem' => 'https://images.unsplash.com/photo-1587556930720-0d554fa8b4c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Farmacologia' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Programação' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Estruturas de Betão' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Circuitos Eléctricos' => 'https://images.unsplash.com/photo-1592659762303-90081d34b277?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Botânica' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Química Geral' => 'https://images.unsplash.com/photo-1532187643603-ba119ca4109e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'Física' => 'https://images.unsplash.com/photo-1636466497217-26a8cbeaf0aa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
        'default' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
    ];

    $userCourse = auth()->user()->course ?? '';
    $disciplines = $courseDisciplines[$userCourse] ?? [];

    // Buscar publicações do curso atual
    $publications = \App\Models\Publication::where('course', $userCourse)
        ->where('is_published', true)
        ->get();

    // Agrupar publicações por disciplina
    $publicationsByDiscipline = $publications->groupBy('discipline');
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Disciplinas de {{ $userCourse }}</h1>
        <p class="mt-2 text-gray-600">Explore publicações das disciplinas do seu curso</p>
    </div>

    <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach($disciplines as $discipline)
            <div class="bg-white overflow-hidden shadow rounded-lg transition hover:shadow-lg">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $disciplineImages[$discipline] ?? $disciplineImages['default'] }}" 
                         alt="{{ $discipline }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900 to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h2 class="text-2xl font-bold text-white">{{ $discipline }}</h2>
                        <p class="text-blue-100">
                            {{ $publicationsByDiscipline->get($discipline)?->count() ?? 0 }} publicações
                        </p>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">
                        Explore os materiais acadêmicos relacionados a {{ $discipline }}.
                    </p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @php
                            $disciplinePublications = $publicationsByDiscipline->get($discipline) ?? collect();
                            $types = $disciplinePublications->groupBy('publication_type.name');
                        @endphp
                        @foreach($types as $type => $publications)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $type }} ({{ $publications->count() }})
                            </span>
                        @endforeach
                    </div>
                    <a href="{{ route('publications.index', ['discipline' => $discipline, 'course' => $userCourse]) }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                        Ver publicações
                        <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection