@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Editar Consulta com {{ $consulta->medico->nome }} - Especialidade: {{ $consulta->medico->especialidade->nome }}</h1>

    <form action="{{ route('consulta.update', $consulta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="data_consulta" class="form-label">Data da Consulta:</label>
            <input type="date" name="data_consulta" class="form-control" value="{{ old('data_consulta', $consulta->data_consulta) }}">
        </div>

        <div class="mb-3">
            <label for="hora_consulta" class="form-label">Hora da Consulta:</label>
            <input type="time" name="hora_consulta" class="form-control" value="{{ old('hora_consulta', $consulta->hora_consulta) }}">
        </div>

        <div class="d-flex justify-content-center gap-5">
            <a href="{{ route('paciente.dashboard') }}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
    </form>
</div>
@endsection