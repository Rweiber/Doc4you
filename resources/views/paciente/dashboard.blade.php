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

            @if ($consultas->count() > 0)
                <table class="table text-center border">
                    <thead>
                        <tr >
                            <th class="border border-secondary">Médico</th>
                            <th class="border border-secondary">Especialidade</th>
                            <th class="border border-secondary">Data</th>
                            <th class="border border-secondary">Hora</th>
                            {{-- Adicione outras colunas conforme necessário --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultas as $consulta)
                            <tr>
                                <td class="border border-secondary">{{ $consulta->medico->nome }}</td>
                                <td class="border border-secondary">{{$consulta->medico->especialidade->nome}}</td>
                                <td class="border border-secondary">{{ date('d/m/Y', strtotime($consulta->data_consulta)) }}</td>
                                <td class="border border-secondary">{{ $consulta->hora_consulta }}</td>
                                {{-- Exiba outros dados da consulta --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="card-text">Você não possui consultas agendadas.</p>
            @endif
        </div>
    </div>
</div>
@endsection