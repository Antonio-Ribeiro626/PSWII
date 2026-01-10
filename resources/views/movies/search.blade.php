@extends('layouts.main')

@section('content')

<h1>Buscar Filmes</h1>

<form method="GET" action="{{ route('movies.search') }}">
    <input type="text" name="query" placeholder="Digite o nome do filme" value="{{ request('query') }}">
    <button type="submit">Buscar</button>
</form>

<hr>

@if(isset($movies) && count($movies) > 0)
    <div style="display:flex; flex-wrap:wrap;">
        @foreach($movies as $movie)
            <div style="margin:10px; width:200px;">
                
                @if($movie['poster_path'])
                    <img 
                        src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                        width="200"
                    >
                @endif

                <h4>{{ $movie['title'] }}</h4>
<h5>
@if(!empty($movie['genre_names']))
    {{ implode(', ', $movie['genre_names']) }}
@else
    Sem gêneros
@endif
</h5>
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


                    <button type="submit">Adicionar</button>
                </form>

            </div>
        @endforeach
    </div>
@elseif(request('query'))
    <p>Nenhum filme encontrado.</p>
@endif

@endsection
