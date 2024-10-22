<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Doc4You')</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom mb-3">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo do App" class="logo mb-3">
        </a>
        <div class="d-flex align-items-center"> 
            @auth('pacientes')
                @if (Route::currentRouteName() === 'paciente.dashboard')
                    <a href="{{ route('consulta') }}" class="btn btn-primary me-3">Agendar Consulta</a>
                @elseif (Route::currentRouteName() === 'consulta')
                    <a href="{{ route('paciente.dashboard') }}" class="btn btn-primary me-3">Voltar</a>
                @endif
            @endauth
            <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle rounded-circle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 50px; height: 50px; padding: 0;">
    <img src="https://avatar.iran.liara.run/public" alt="Perfil" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
</button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    
                    @auth('pacientes')
                        <li><a class="dropdown-item" href="{{ route('paciente.edit', auth()->guard('pacientes')->user()->id) }}">Editar Conta</a></li>
                        <li>
                            <form action="{{ route('paciente.destroy', auth()->guard('pacientes')->user()->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" type="submit" onclick="return confirm('Tem certeza que deseja excluir sua conta?')">Excluir Conta</button>
                            </form>
                        </li>
                    @endauth

                    @auth('medicos')
                        <li><a class="dropdown-item" href="{{ route('medico.edit', auth()->guard('medicos')->user()->id) }}">Editar Conta</a></li>
                        <li>
                            <form action="{{ route('medico.destroy', auth()->guard('medicos')->user()->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" type="submit" onclick="return confirm('Tem certeza que deseja excluir sua conta?')">Excluir Conta</button>
                            </form>
                        </li>
                    @endauth

                    <!-- Botão de Logout dentro do dropdown -->
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <main class="flex-grow-1">
        @yield('content')
    </main>
    <footer class="bg-white text-black text-center py-4">
        <div>
            <p class="fw-bold m-0">&copy; 2024 Doc4You - Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>