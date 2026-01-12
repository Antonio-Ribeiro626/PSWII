@extends('layouts.main')

@section('content')

@php
    $movieDesc = $movies->first();
    use Illuminate\Support\Str;
@endphp

<div class="relative -mx-4 mb-12 mt-7">
    <div class="relative h-96 md:h-[500px] bg-cover bg-center" style="background-image: url('https://image.tmdb.org/t/p/original{{ $movieDesc->backdrop_path }}');">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
        
        <div class="relative h-full max-w-7xl mx-auto px-4 flex flex-col justify-end pb-12">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-4 drop-shadow-2xl">
                {{ $movieDesc->title }}
            </h2>
            <p class="text-lg text-gray-200 max-w-3xl mb-6 leading-relaxed">
                {{ Str::limit($movieDesc->overview, 200, '...') }}
            </p>
            <div class="flex gap-4">
                <button onclick="window.location='{{ route('movies.show', $movieDesc->id) }}'" class="bg-white hover:bg-gray-100 text-gray-900 font-bold px-8 py-3 rounded-xl transition-colors duration-200 shadow-xl">
                    Ver Detalhes
                </button>
<button onclick="window.location='{{ route('movies.show', $movieDesc->id) }}'"
    class="bg-gray-800/80 hover:bg-gray-700/80 backdrop-blur-sm text-white font-bold px-8 py-3 rounded-xl transition-colors duration-200">
    Dar Opinião
</button>

            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 pb-16">
    <h2 class="text-3xl font-bold text-black-900 dark:text-black mb-8">
        Filmes Populares
    </h2>

    <div class="cards">
        @foreach($movies as $movie)
            <div class="group cursor-pointer" onclick="window.location='{{ route('movies.show', $movie->id) }}'">
                
                <div class="relative aspect-[2/3] bg-gray-200 dark:bg-gray-800 rounded-lg overflow-hidden mb-3 shadow-sm">
                    @if($movie->poster_path)
                        <img 
                            src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}"
                            alt="{{ $movie->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                        >
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-12 h-12 text-black-400 dark:text-black-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                            </svg>
                        </div>
                    @endif
                    
                    @if($movie->rating)
                        <div class="absolute top-2 right-2 bg-black/80 text-white font-medium px-2 py-1 rounded text-xs backdrop-blur-sm">
                            ⭐ {{ number_format($movie->rating, 1) }}
                        </div>
                    @endif
                </div>

                <div class="space-y-1">
                    <h3 class="font-semibold text-gray-900 dark:text-black text-sm line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $movie->title }}
                    </h3>
                    
                    <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-1">
                        {{ $movie->genres ?? 'Sem gêneros' }}
                    </p>
                    
                    @if($movie->release_date)
                        <p class="text-xs text-gray-500 dark:text-gray-500">
                            {{ date('Y', strtotime($movie->release_date)) }}
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection