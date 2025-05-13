@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Painel do Usuário</h2>
                <p class="text-gray-600">Bem-vindo ao seu painel de controle.</p>
                
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900">Suas Atividades Recentes</h3>
                    
                    <div class="mt-4 bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-500 italic">Nenhuma atividade recente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 