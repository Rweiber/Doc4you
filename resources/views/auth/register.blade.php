@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Registrar</h1>

        <form action="{{ route('registrar.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tipo" class="form-label">Você é:</label>
                <select name="tipo" id="tipo" class="form-select" onchange="this.form.submit()">
                    <option value="">Selecione</option>
                    <option value="medico" {{ old('tipo') === 'medico' ? 'selected' : '' }}>Médico</option>
                    <option value="paciente" {{ old('tipo') === 'paciente' ? 'selected' : '' }}>Paciente</option>
                </select>
            </div>

            @if (old('tipo') === 'medico')
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>

                <div class="mb-3">
                    <label for="crm" class="form-label">CRM:</label>
                    <input type="text" name="crm" id="crm" class="form-control" value="{{ old('crm') }}" required>
                </div>

                <div class="mb-3">
                    <label for="especialidade_id" class="form-label">Especialidade:</label>
                    <select name="especialidade_id" id="especialidade_id" class="form-select">
                        @foreach($especialidades as $especialidade)
                            <option value="{{ $especialidade->id }}" {{ old('especialidade_id') == $especialidade->id ? 'selected' : '' }}>
                                {{ $especialidade->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
            @elseif (old('tipo') === 'paciente')
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" name="cpf" id="cpf" 
                        class="form-control" 
                        value="{{ old('cpf') }}" required>
                    <span>
                        @error('cpf')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>

                <div id="telefones-container">
                    <div class="mb-3 telefone-item">
                        <label for="telefone[]" class="form-label">Telefone:</label>
                        <input type="text" name="telefone[]" class="form-control" value="{{ old('telefone.0') }}">
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" id="add-telefone">Adicionar Telefone</button>

                <div class="mb-3">
                    <label for="cep" class="form-label">CEP:</label>
                    <input type="text" name="cep" id="cep" class="form-control" value="{{ old('cep') }}" required>
                </div>

                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço:</label>
                    <input type="text" name="endereco" id="endereco" class="form-control" value="{{ old('endereco') }}" required>
                </div>

                <div class="mb-3">
                    <label for="numero" class="form-label">Número:</label>
                    <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero') }}" required>
                </div>

                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro:</label>
                    <input type="text" name="bairro" id="bairro" class="form-control" value="{{ old('bairro') }}" required>
                </div>

                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade:</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade') }}" required>
                </div>

                <div class="mb-3">
                    <label for="uf" class="form-label">UF:</label>
                    <input type="text" name="uf" id="uf" class="form-control" value="{{ old('uf') }}" required>
                </div>

                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}" required>
                </div>

                <div id="responsavel" style="display: none;">
                    <div class="mb-3">
                        <label for="responsavel_nome" class="form-label">Nome do responsável:</label>
                        <input type="text" name="responsavel_nome" id="responsavel_nome" class="form-control" value="{{ old('responsavel_nome') }}" >
                    </div>

                    <div class="mb-3">
                        <label for="responsavel_cpf" class="form-label">CPF do responsável:</label>
                        <input type="text" name="responsavel_cpf" id="responsavel_cpf" class="form-control" value="{{ old('responsavel_cpf') }}" >
                    </div>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        function verificaIdade() {
            var dataNascimento = document.getElementById('data_nascimento');
            if (dataNascimento && dataNascimento.value) {
                var hoje = new Date();
                var nascimento = new Date(dataNascimento.value);
                var idade = hoje.getFullYear() - nascimento.getFullYear();
                var mes = hoje.getMonth() - nascimento.getMonth();
                if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
                    idade--;
                }
                // Exibe ou oculta os campos do responsável
                document.getElementById('responsavel').style.display = idade < 18 ? 'block' : 'none';
            }
        }

        // Preenche o campo de responsável automaticamente com base na idade
        var dataNascimentoInput = document.getElementById('data_nascimento');
        if (dataNascimentoInput) {
            dataNascimentoInput.addEventListener('change', verificaIdade);
        }

        // Preenchimento automático de endereço com API ViaCEP
        var cepInput = document.getElementById('cep');
        if (cepInput) {
            cepInput.addEventListener('blur', function() {
                var cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
                if (cep.length === 8) { // Verifica se o CEP tem 8 dígitos
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (!("erro" in data)) {
                                // Preenche os campos de endereço com os dados retornados da API
                                document.getElementById('endereco').value = data.logradouro;
                                document.getElementById('bairro').value = data.bairro;
                                document.getElementById('cidade').value = data.localidade;
                                document.getElementById('uf').value = data.uf;
                            } else {
                                alert("CEP não encontrado.");
                            }
                        })
                        .catch(error => {
                            alert("Erro ao consultar o CEP.");
                            console.error(error);
                        });
                }
            });
        }

        // Validação de CPF ao sair do campo
        var cpfInput = document.getElementById('cpf');
            if (cpfInput) {
                cpfInput.addEventListener('blur', function() {
                    var cpf = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
                    if (!validaCpf(cpf)) {
                        this.classList.add('is-invalid'); // Adiciona a classe de erro
                        alert('CPF inválido.');
                    } else {
                        this.classList.remove('is-invalid'); // Remove a classe de erro caso o CPF seja válido
                    }
                });
            }

            // Função de validação de CPF
            function validaCpf(cpf) {
                if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
                    return false;
                }
                var soma = 0, resto;
                for (var i = 1; i <= 9; i++) {
                    soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
                }
                resto = (soma * 10) % 11;
                if ((resto === 10) || (resto === 11)) resto = 0;
                if (resto != parseInt(cpf.substring(9, 10))) return false;
                soma = 0;
                for (var i = 1; i <= 10; i++) {
                    soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
                }
                resto = (soma * 10) % 11;
                if ((resto === 10) || (resto === 11)) resto = 0;
                return resto == parseInt(cpf.substring(10, 11));
            }
            // Adicionar campos de telefone
            var addTelefoneButton = document.getElementById('add-telefone');
            addTelefoneButton.addEventListener('click', function() {
                var telefonesContainer = document.getElementById('telefones-container');
                var telefoneCount = telefonesContainer.getElementsByClassName('telefone-item').length;
                
                var newTelefoneItem = document.createElement('div');
                newTelefoneItem.className = 'mb-3 telefone-item';
                newTelefoneItem.innerHTML = `
                    <label for="telefone[]" class="form-label">Telefone:</label>
                    <input type="text" name="telefone[]" class="form-control" value="{{ old('telefone.${telefoneCount}') }}">
                `;
                telefonesContainer.appendChild(newTelefoneItem);
            });
        });

    </script>
@endsection
