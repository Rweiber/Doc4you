@extends('layouts.dashboard')

@section('content')
<div class="container">

    @if (session('success'))
        <div class="alert alert-success text-center mx-3">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-center mb-4">Bem-vindo, {{ $paciente->nome }} !</h2>

    <div class="card mb-4">
        <div class="card-body text-center">
            <h5 class="card-title">Minhas Consultas</h5>

            @if($consultas->count() > 0)
    <div class="row">
        @foreach($consultas as $consulta)
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Consulta com Dr(a) {{ $consulta->medico->nome }}</h5>
                    <p class="card-text">Data: {{ \Carbon\Carbon::parse($consulta->data_consulta)->format('d/m/Y') }}</p>
                    <p class="card-text">Hora: {{ $consulta->hora_consulta }}</p>

                    <!-- Botão Editar -->
                    <a href="{{ route('consulta.edit', $consulta->id) }}" class="btn btn-warning">Editar</a>

                    <!-- Botão Cancelar (com confirmação) -->
                    <form action="{{ route('consulta.cancelar', $consulta->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar a consulta?');">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>Você não tem consultas agendadas.</p>
    @endif
</div>
@endsection