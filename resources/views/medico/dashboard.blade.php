@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Bem-vindo, Dr(a) {{ $medico->nome }}!</h2>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title text-center mb-3">Consultas Agendadas</h5>

                @if ($consultas->isEmpty())
                    <p class="text-center">Você ainda não possui consultas agendadas</p>
                @else
                    <table class="table table-striped text-center border">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultas as $consulta)
                                <tr>
                                    <td class="align-middle">{{ date('d/m/Y', strtotime($consulta->data_consulta)) }}</td>
                                    <td class="align-middle">{{ $consulta->hora_consulta }}</td>
                                    <td class="align-middle">{{ $consulta->paciente->nome }}</td>
                                    <td class="align-middle">
                                        <!-- Botão de Cancelar Consulta -->
                                        <form class="mb-2" action="{{ route('consulta.cancelar', $consulta->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar esta consulta?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                                        </form>

                                        <!-- Botão para Ver Mais Detalhes -->
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detalhesConsulta{{ $consulta->id }}">
                                            Ver Mais
                                        </button>

                                        <!-- Modal para exibir os detalhes da consulta -->
                                        <div class="modal fade" id="detalhesConsulta{{ $consulta->id }}" tabindex="-1" aria-labelledby="detalhesConsultaLabel{{ $consulta->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detalhesConsultaLabel{{ $consulta->id }}">Detalhes da Consulta</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Dados do Paciente:</h6>
                                                        <ul>
                                                            <li><strong>Nome:</strong> {{ $consulta->paciente->nome }}</li>
                                                            <li><strong>Email:</strong> {{ $consulta->paciente->email }}</li>
                                                            <li><strong>Data de Nascimento:</strong> {{ date('d/m/Y', strtotime($consulta->paciente->data_nascimento)) }}</li>
                                                            <li><strong>Telefones:</strong>
                                                                <ul>
                                                                    @foreach ($consulta->paciente->telefones as $telefone)
                                                                        <li>{{ $telefone->numero }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                            @if ($consulta->paciente->responsavel_nome && $consulta->paciente->responsavel_cpf)
                                                                <li><strong>Responsável:</strong> {{ $consulta->paciente->responsavel_nome }} (CPF: {{ $consulta->paciente->responsavel_cpf }})</li>
                                                            @endif
                                                        </ul>

                                                        <h6>Dados da Consulta:</h6>
                                                        <ul>
                                                            <li><strong>Data:</strong> {{ date('d/m/Y', strtotime($consulta->data_consulta)) }}</li>
                                                            <li><strong>Hora:</strong> {{ $consulta->hora_consulta }}</li>
                                                            <li><strong>Motivo da Consulta:</strong> {{ $consulta->motivo }}</li> <!-- Exemplo de campo extra -->
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fim do Modal -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
