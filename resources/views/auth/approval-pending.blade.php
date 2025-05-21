@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                Aguardando Aprovação
            </h2>
            <div class="mb-4">
                <svg class="mx-auto h-12 w-12 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-gray-600 mb-4">
                Sua conta está aguardando aprovação do administrador. Você receberá um e-mail quando sua conta for aprovada.
            </p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Sair
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 