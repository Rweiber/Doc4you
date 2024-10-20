@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Bem-vindo, Dr(a) {{ $medico->nome }}!</h2>

        <div class="card mb-4 ">
            <div class="card-body text-center ">
                <h5 class="card-title">Consultas Agendadas</h5>
                
                @if ($consultas->isEmpty())
                    <p>Não há consultas agendadas.</p>
                @else
                    <ul class="list-group">
                        @foreach ($consultas as $consulta)
                            <li class="list-group-item">
                                Data: {{ date('d/m/Y', strtotime($consulta->data_consulta)) }} - Hora: {{ $consulta->hora_consulta }} - Paciente: {{ $consulta->paciente->nome }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Adicione mais seções conforme necessário -->
    </div>
@endsection
