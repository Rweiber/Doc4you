@extends('layouts.dashboard')

@section('content')
    <div class="container">
        
        <h2 class="text-center mb-4">Bem-vindo, {{ $paciente->nome }} !</h2>

        <div class="card mb-4">
            <div class="card-body text-center">
                <h5 class="card-title">Minhas Consultas</h5>
                <p class="card-text">Aqui você pode visualizar e gerenciar suas consultas.</p>
                <a href="" class="btn btn-primary">Ver Consultas</a>
            </div>
        </div>

        <!-- Adicione mais seções conforme necessário -->
    </div>
@endsection
