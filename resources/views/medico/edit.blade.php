@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Conta</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('medico.update', $medico->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" value="{{ $medico->nome }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $medico->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="especialidade_id" class="form-label">Especialidade</label>
                        <select name="especialidade_id" class="form-select" required>
                            @foreach ($especialidades as $especialidade)
                                <option value="{{ $especialidade->id }}" {{ $especialidade->id == $medico->especialidade_id ? 'selected' : '' }}>
                                    {{ $especialidade->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="crm" class="form-label">CRM</label>
                        <input type="text" name="crm" class="form-control" value="{{ $medico->crm }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" placeholder="Deixe em branco para não alterar">
                    </div>

                    <div class="d-flex justify-content-center gap-5">
                        <a href="{{ route('medico.dashboard') }}" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
