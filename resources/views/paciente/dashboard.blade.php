@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Dashboard do Paciente</h1>
        <p>Bem-vindo, {{ auth()->user()->nome }}!</p>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Minhas Consultas</h5>
                <p class="card-text">Aqui você pode visualizar e gerenciar suas consultas.</p>
                <a href="{{ route('paciente.consultas') }}" class="btn btn-primary">Ver Consultas</a>
            </div>
        </div>

        <!-- Adicione mais seções conforme necessário -->
    </div>
@endsection
