@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Conta</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('paciente.update', $paciente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" value="{{ $paciente->nome }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control" value="{{ $paciente->cpf }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $paciente->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" placeholder="Deixe em branco para não alterar">
                    </div>

                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" name="cep" class="form-control" value="{{ $paciente->cep }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" name="endereco" class="form-control" value="{{ $paciente->endereco }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" name="bairro" class="form-control" value="{{ $paciente->bairro }}">
                    </div>

                    <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" name="cidade" class="form-control" value="{{ $paciente->cidade }}">
                    </div>

                    <div class="mb-3">
                        <label for="uf" class="form-label">UF</label>
                        <input type="text" name="uf" class="form-control" value="{{ $paciente->uf }}" maxlength="2" required>
                    </div>

                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" name="numero" class="form-control" value="{{ $paciente->numero }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control" value="{{ $paciente->data_nascimento }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="responsavel_nome" class="form-label">Nome do Responsável (opcional)</label>
                        <input type="text" name="responsavel_nome" class="form-control" value="{{ $paciente->responsavel_nome }}">
                    </div>

                    <div class="mb-3">
                        <label for="responsavel_cpf" class="form-label">CPF do Responsável (opcional)</label>
                        <input type="text" name="responsavel_cpf" class="form-control" value="{{ $paciente->responsavel_cpf }}">
                    </div>

                    <div class="d-flex justify-content-center gap-5">
                        <a href="{{ route('paciente.dashboard') }}" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
