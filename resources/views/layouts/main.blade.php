<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bem Vindo ao MovieC</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header class="">
        <nav class="nav-bar container">
            <div class="logo">
                <img src="{{ asset('imagens/Logo.svg') }}" alt="">
            </div>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Sobre</a></li>
                <li><a href="#">Saiba Mais</a></li>
            </ul>
        <div class="last-items">
            <div class="switchMode">
                    <img src="{{ asset('imagens/white-mode.svg') }}" alt="WhiteMode">
                    <img src="{{ asset('imagens/dark-mode.svg') }}" alt="DarkMode">
            </div>
                <button class="btn-login">
                    <a href="#">
                        <img src="{{ asset('imagens/user-icon.svg') }}" alt="user-icon">
                        Login
                    </a>
                </button>
        </div>
        </nav>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>