<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bem Vindo ao MovieC</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <style>
        /* Reset para evitar conflitos */
        .navbar-custom * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body class="bg-white transition-colors duration-300">
    <header class="navbar-custom bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 shadow-2xl sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('imagens/Logo.svg') }}" alt="MovieC Logo" class="h-10 w-auto">
                    </a>
                </div>

                <!-- Menu Central -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="/" class="px-6 py-2.5 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-200 hover:scale-105">
                        Início
                    </a>
                     @auth
                        @if(auth()->user()->role === 'admin')
                          <a href="{{ route('admin.movies.search') }}" class="flex items-center gap-2 px-6 py-2.5 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-200 hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                       Adicionar
                    </a>
                        @endif
                    @endauth
                    
                    <a href="{{ url('/about') }}" class="px-6 py-2.5 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-200 hover:scale-105">
                        Sobre
                    </a>
                    <a href="{{ url('/saiba-mais') }}" class="px-6 py-2.5 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-200 hover:scale-105">
                        Saiba Mais
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    
                    <button id="theme-toggle" class="p-2.5 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                        <svg id="theme-toggle-light-icon" class="w-6 h-6 text-white hidden group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                        </svg>
                        <svg id="theme-toggle-dark-icon" class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </button>

                    @auth
                        <!-- User Dropdown -->
                        <div class="relative hidden sm:block">
                            <button 
                                onclick="document.getElementById('user-dropdown').classList.toggle('hidden')"
                                class="flex items-center gap-2 bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-600 hover:to-gray-800 text-white font-bold px-6 py-2.5 rounded-xl border-2 border-gray-600 hover:border-gray-500 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 group"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ Auth::user()->name }}
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50">
                                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Perfil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">Sair</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-2 bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-600 hover:to-gray-800 text-white font-bold px-6 py-2.5 rounded-xl border-2 border-gray-600 hover:border-gray-500 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 group">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Login
                        </a>
                            <a href="{{ route('register') }}" class="hidden sm:flex items-center gap-2 bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-600 hover:to-gray-800 text-white font-bold px-6 py-2.5 rounded-xl border-2 border-gray-600 hover:border-gray-500 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 group">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Register
                        </a>
                    @endauth
                </div>
            </div>


        </nav>
    </header>
    

    <main class="min-h-screen transition-colors duration-300">
        <div class="container mx-auto dark:text-gray-100">
            @yield('content')
        </div>
    </main>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    <footer class="bg-gray-900 text-gray-200 dark:text-gray-400 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Sobre -->
        <div>
            <h3 class="text-white text-lg font-bold mb-4">MovieC</h3>
            <p class="text-gray-400 text-sm">O melhor lugar para descobrir filmes incríveis e manter-se atualizado com novidades do cinema. Conecte-se e explore nosso catálogo!</p>
        </div>

        <!-- Links -->
        <div>
            <h3 class="text-white text-lg font-bold mb-4">Links Úteis</h3>
            <ul class="space-y-2">
                <li><a href="/" class="hover:text-white transition-colors">Início</a></li>
                <li><a href="{{ url('/movies') }}" class="hover:text-white transition-colors">Filmes</a></li>
                <li><a href="{{ route('admin.movies.search') }}" class="hover:text-white transition-colors">Buscar Filmes</a></li>
                <li><a href="{{ url('/about') }}" class="hover:text-white transition-colors">Sobre</a></li>
                <li><a href="{{ url('/saiba-mais') }}" class="hover:text-white transition-colors">Saiba Mais</a></li>
            </ul>
        </div>

        <!-- Contato -->
        <div>
            <h3 class="text-white text-lg font-bold mb-4">Contato</h3>
            <ul class="space-y-2 text-sm">
                <li>Email: <a href="mailto:contato@moviec.com" class="hover:text-white transition-colors">contato@moviec.com</a></li>
                <li>Telefone: <a href="tel:+351912345678" class="hover:text-white transition-colors">+351 912 345 678</a></li>
                <li>Redes sociais:
                    <div class="flex gap-3 mt-1">
                        <a href="#" class="hover:text-white transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-.77.34-1.5.56-2.3.66a4.15 4.15 0 001.84-2.3 8.19 8.19 0 01-2.6.98 4.12 4.12 0 00-7.03 3.75 11.7 11.7 0 01-8.5-4.3 4.12 4.12 0 001.27 5.5 4.06 4.06 0 01-1.86-.5v.05a4.12 4.12 0 003.3 4 4.1 4.1 0 01-1.85.07 4.12 4.12 0 003.85 2.85 8.24 8.24 0 01-5.1 1.77A8.28 8.28 0 012 19.54a11.64 11.64 0 006.29 1.84c7.55 0 11.68-6.27 11.68-11.71v-.53a8.18 8.18 0 002-2.08z"/></svg></a>
                        <a href="#" class="hover:text-white transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.2c5.42 0 9.8 4.38 9.8 9.8s-4.38 9.8-9.8 9.8S2.2 17.42 2.2 12 6.58 2.2 12 2.2zm0 1.6a8.2 8.2 0 100 16.4 8.2 8.2 0 000-16.4zm0 2a4.2 4.2 0 110 8.4 4.2 4.2 0 010-8.4zm0 1.6a2.6 2.6 0 100 5.2 2.6 2.6 0 000-5.2z"/></svg></a>
                        <a href="#" class="hover:text-white transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.04c-5.52 0-10 4.48-10 10 0 4.42 2.86 8.15 6.84 9.5v-6.7h-2.06v-2.8h2.06V9.68c0-2.04 1.22-3.18 3.08-3.18.9 0 1.84.16 1.84.16v2.02h-1.04c-1.02 0-1.34.63-1.34 1.28v1.54h2.28l-.36 2.8h-1.92v6.7c3.98-1.35 6.84-5.08 6.84-9.5 0-5.52-4.48-10-10-10z"/></svg></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="border-t border-gray-700 mt-8 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
        &copy; {{ date('Y') }} MovieC. Todos os direitos reservados.
    </div>
</footer>
</body>
</html>
