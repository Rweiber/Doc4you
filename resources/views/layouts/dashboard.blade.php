<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Doc4You')</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Cabeçalho -->
    <header class="d-flex align-items-center justify-content-between mx-3 border-bottom mb-3">
        <a href="{{url('/')}}">

            <img src="{{ asset('images/logo.png') }}" alt="Logo do App" class="logo mb-3">
        </a>

        <div>
            @auth('pacientes')
                <a href="{{ route('consulta') }}" class="btn btn-primary me-3">Agendar Consulta</a>
            @endauth
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary">Logout</button>
            </form>
        </div>
    </header>

    <!-- Conteúdo da Página -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Rodapé -->
    <footer class="bg-white text-black text-center py-4">
        <div>
            <p class="fw-bold m-0">&copy; 2024 Doc4You - Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>