@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Agendar Consulta</h1>

        {{-- Define $mostrarBusca se não estiver definido --}}
        @if (!isset($mostrarBusca))
            @php $mostrarBusca = true; @endphp 
        @endif


        {{-- Verifica se o paciente pode ou não ver o formulário de busca --}}
        @if($mostrarBusca)
            <!-- Formulário de Busca -->
            <form method="GET" action="{{ route('consulta.buscar') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="especialidade" class="form-label">Buscar por Especialidade:</label>
                        <select name="especialidade_id" id="especialidade" class="form-control">
                            <option value="">Selecione uma especialidade</option>
                            @foreach($especialidades as $especialidade)
                                <option value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="crm" class="form-label">Buscar por CRM:</label>
                        <input type="text" name="crm" id="crm" class="form-control" placeholder="Digite o CRM">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Buscar</button>
            </form>
        @else
            <p>Exibindo apenas médicos pediatras devido à idade do paciente.</p>
        @endif

        <!-- Exibição dos médicos -->
        @if(isset($medicos) && $medicos->count() > 0)
        <div class="row">
            @foreach($medicos as $medico)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $medico->nome }}</h5>
                            <p class="card-text">CRM: {{ $medico->crm }}</p>
                            <p class="card-text">Especialidade: {{ $medico->especialidade->nome }}</p>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agendarConsultaModal-{{ $medico->id }}">
                                Agendar Consulta
                            </button>
                            
                        </div>
                    </div>
                </div>

                
                {{-- Modal para cada médico --}}
                <div class="modal fade" id="agendarConsultaModal-{{ $medico->id }}" tabindex="-1" aria-labelledby="agendarConsultaModalLabel-{{ $medico->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agendarConsultaModalLabel-{{ $medico->id }}">Agendar Consulta com {{ $medico->nome }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('consulta.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="medico_id" value="{{ $medico->id }}">
                                    <input type="hidden" name="paciente_id" value="{{ auth()->guard('pacientes')->user()->id }}">  {{-- ID do paciente logado --}}

                                    <div class="mb-3">
                                        <label for="data_consulta" class="form-label">Data da Consulta:</label>
                                        <input type="date" name="data_consulta" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hora_consulta" class="form-label">Hora da Consulta:</label>
                                        <input type="time" name="hora_consulta" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Agendar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @elseif(request()->has('especialidade_id') || request()->has('crm'))
        <p>Nenhum médico encontrado.</p>
    @endif

</div>
@endsection
