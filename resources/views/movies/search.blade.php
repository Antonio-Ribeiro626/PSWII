@extends('layouts.main')

@section('content')

<div class="container">
        <h1 class="head">
            Procurar por  Filmes
        </h1>
        <p class="search-p">
            Encontre e adicione filmes a base de dados
        </p>
</div>

<div class="max-w-7xl mx-auto px-4 mb-12">
    <form method="GET" action="{{ route('admin.movies.search') }}">
        <div class="flex gap-3">
            <input 
                type="text" 
                name="query" 
                placeholder="Digite o nome do filme..." 
                value="{{ request('query') }}"
                class="flex-1 px-5 py-3.5 text-base rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-500 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all"
                required
            >
            <button 
                type="submit" 
                class="px-8 py-3.5 bg-gray-800 dark:bg-gray-700 hover:bg-gray-900 dark:hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors duration-200 flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Buscar
            </button>
        </div>
    </form>
</div>

<div class="max-w-7xl mx-auto px-4 pb-16">
    @if(isset($movies) && count($movies) > 0)
        <div class="mb-8 px-5 py-4 rounded-xl">
            <p class="text-black font-medium text-base">
                {{ count($movies) }} resultados para "<span class="font-bold">{{ request('query') }}</span>"
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
            @foreach($movies as $movie)
                <div class="group">
                    
                    <div class="relative aspect-[2/3] bg-gray-200 dark:bg-gray-800 rounded-lg overflow-hidden mb-3 shadow-sm">
                        @if($movie['poster_path'])
                            <img 
                                src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                alt="{{ $movie['title'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                loading="lazy"
                            >
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                                </svg>
                            </div>
                        @endif
                        
                        @if(isset($movie['vote_average']) && $movie['vote_average'] > 0)
                            <div class="absolute top-2 right-2 bg-yellow-500 text-gray-900 font-bold px-2.5 py-1 rounded text-xs shadow-lg">
                                ⭐ {{ number_format($movie['vote_average'], 1) }}
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <h3 class="font-semibold text-black-900 dark:text-black text-sm line-clamp-2 leading-snug">
                            {{ $movie['title'] }}
                        </h3>
                        
                        <p class="text-xs text-black-700 dark:text-black line-clamp-1">
                            @if(!empty($movie['genre_names']))
                                {{ implode(', ', array_slice($movie['genre_names'], 0, 2)) }}
                            @else
                                —
                            @endif
                        </p>

                        <form method="POST" action="{{ route('movies.store') }}">
                            @csrf
                            <input type="hidden" name="tmdb_id" value="{{ $movie['id'] }}">
                            <input type="hidden" name="title" value="{{ $movie['title'] }}">
                            <input type="hidden" name="overview" value="{{ $movie['overview'] ?? '' }}">
                            <input type="hidden" name="poster_path" value="{{ $movie['poster_path'] ?? '' }}">
                            <input type="hidden" name="backdrop_path" value="{{ $movie['backdrop_path'] ?? '' }}">
                            <input type="hidden" name="release_date" value="{{ $movie['release_date'] ?? '' }}">
                            <input type="hidden" name="rating" value="{{ $movie['vote_average'] ?? 0 }}">
                            <input type="hidden" name="genre_names" value="{{ isset($movie['genre_names']) ? implode(',', $movie['genre_names']) : '' }}">

                            <button 
                                type="submit" 
                                class="w-full bg-gray-800 dark:bg-gray-700 hover:bg-gray-900 dark:hover:bg-gray-600 text-white font-medium py-2 rounded-lg transition-colors duration-200 text-sm"
                            >
                                Adicionar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    @elseif(request('query'))
        <div class="text-center py-20">
            <svg class="w-16 h-16 text-gray-500 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                Nenhum filme encontrado
            </h3>
            <p class="text-gray-700 dark:text-gray-300">
                Tente buscar com outro termo
            </p>
        </div>

    @else
        <div class="text-center py-20">
            <svg class="w-16 h-16 text-gray-500 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <p class="text-gray-700 dark:text-gray-300">
                Digite o nome de um filme para começar
            </p>
        </div>
    @endif
</div>

@endsection