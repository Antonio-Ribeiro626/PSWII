@extends('layouts.main')
@section('content')

<!-- Banner Hero com Título -->
<div class="relative -mx-4 mb-8">
    <div class="h-72 md:h-96 bg-cover bg-center relative overflow-hidden" 
         style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.8)), url('https://image.tmdb.org/t/p/original{{ $movie->backdrop_path }}');">
        <div class="absolute inset-0 flex items-end justify-center p-6 md:p-10">
            <h1 class="text-4xl md:text-6xl text-white font-black text-center drop-shadow-2xl max-w-4xl">
                {{ $movie->title }}
            </h1>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 pb-16">
    <div class="flex flex-col lg:flex-row gap-10">

        <!-- Coluna da Esquerda - Poster -->
        <div class="lg:w-1/3">
            <div class="sticky top-6">
                @if($movie->poster_path)
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" 
                         alt="{{ $movie->title }}" 
                         class="w-full rounded-3xl shadow-2xl hover:shadow-3xl hover:scale-[1.02] transition-all duration-300">
                @else
                    <div class="bg-gradient-to-br from-gray-200 to-gray-400 aspect-[2/3] w-full flex flex-col items-center justify-center rounded-3xl shadow-xl">
                        <svg class="w-24 h-24 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                        <span class="text-gray-600 font-semibold text-lg">Poster Indisponível</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Coluna da Direita -->
        <div class="lg:w-2/3 space-y-6">

            <!-- Sinopse -->
            <div class="bg-white rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-blue-500 to-blue-600 rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">Sinopse</h2>
                </div>
                <p class="text-gray-700 text-lg leading-relaxed">
                    {{ $movie->overview ?? 'Descrição não disponível para este filme.' }}
                </p>
            </div>

            <!-- Gêneros -->
            <div class="bg-white rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-purple-500 to-purple-600 rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">Gêneros</h2>
                </div>
                <div class="flex flex-wrap gap-3">
                    @if($movie->genres)
                        @foreach(explode(',', $movie->genres) as $genre)
                            <span class="inline-flex items-center bg-gradient-to-r from-blue-500 to-purple-600 text-white text-sm font-semibold px-6 py-3 rounded-full shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-200 cursor-default">
                                {{ trim($genre) }}
                            </span>
                        @endforeach
                    @else
                        <span class="bg-gray-200 text-gray-600 text-sm px-6 py-3 rounded-full">Sem informação de gêneros</span>
                    @endif
                </div>
            </div>

            <!-- Informações -->
            <div class="bg-white rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-green-500 to-green-600 rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">Informações</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Lançamento -->
                    <div class="flex items-center gap-5 p-5 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl hover:scale-105 transition-transform duration-200">
                        <div class="bg-blue-500 p-4 rounded-2xl shadow-lg flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-blue-600 font-semibold uppercase tracking-wide mb-1">Lançamento</p>
                            <p class="text-xl font-bold text-gray-900">
                                {{ $movie->release_date ? date('d/m/Y', strtotime($movie->release_date)) : 'Desconhecida' }}
                            </p>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-center gap-5 p-5 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl hover:scale-105 transition-transform duration-200">
                        <div class="bg-yellow-500 p-4 rounded-2xl shadow-lg flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-yellow-600 font-semibold uppercase tracking-wide mb-1">Avaliação</p>
                            <p class="text-xl font-bold text-gray-900">
                                @if($movie->rating)
                                    <span class="text-3xl">{{ number_format($movie->rating, 1) }}</span><span class="text-gray-600">/10</span>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botão Voltar -->
            <div class="pt-4">
                <a href="{{ url('/movies') }}" 
                   class="group inline-flex items-center justify-center gap-3 bg-gradient-to-r from-gray-800 via-gray-900 to-black text-white px-10 py-5 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300">
                    <svg class="w-6 h-6 group-hover:-translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar para Filmes
                </a>
            </div>

            <!-- Botão Comentar -->
            <div class="pt-4">
                <button id="open-comment-form" 
                    class="px-6 py-5 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 shadow-lg transition-all duration-300">
                    Comentar
                </button>
            </div>

            <!-- Formulário de comentário -->
            <form id="comment-form" action="{{ route('comments.store', $movie->id) }}" method="POST" class="mb-6 mt-4 hidden">
                @csrf
                <textarea name="body" rows="3" class="text-black w-full p-3 rounded-xl border" placeholder="Escreva um comentário..."></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Enviar</button>
            </form>

            <!-- Comentários -->
            <div class="mt-10">
                <h3 class="text-xl font-bold mb-4 text-black">Comentários</h3>

                @foreach($movie->comments as $comment)
                    <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl">
                        <p class="text-sm text-gray-700 dark:text-gray-300"><strong>{{ $comment->user->name }}</strong> comentou:</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $comment->body }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
                @auth
    @if(auth()->user()->role === 'admin')
        <form 
            action="{{ route('movies.destroy', $movie->id) }}" 
            method="POST"
            onsubmit="return confirm('Tens a certeza que queres apagar este filme?')"
            class="mt-6"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-4 rounded-2xl shadow-lg transition-all duration-300"
            >
                🗑 Apagar Filme
            </button>
        </form>
    @endif
@endauth
            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('open-comment-form').addEventListener('click', function() {
    @if(auth()->check())
        // Usuário logado: mostra o form
        const form = document.getElementById('comment-form');
        form.classList.toggle('hidden');
        form.scrollIntoView({ behavior: 'smooth' });
    @else
        // Usuário não logado: redireciona para login
        window.location.href = "{{ route('login') }}";
    @endif
});
</script>

@endsection
