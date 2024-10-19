@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Login</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Entrar</button>
    </form>

    <div class="text-center mt-3">
        <p>Não tem uma conta? <a href="{{ route('registrar') }}">Registre-se aqui</a></p>
    </div>
</div>
@endsection
