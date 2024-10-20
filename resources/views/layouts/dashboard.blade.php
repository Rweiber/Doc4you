<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Doc4You')</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Cabeçalho -->
    <header class="d-flex align-items-center justify-content-between mx-3 border-bottom mb-3">
        <a href="{{url('/')}}">

            <img src="{{ asset('images/logo.png') }}" alt="Logo do App" class="logo mb-3">
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
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