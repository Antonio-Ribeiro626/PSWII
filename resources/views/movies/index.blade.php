@extends('layouts.main')


@section('content')

<h2>Populares</h2>
<div class="cards">
    @foreach ( $movies as $movie )
        <div class="card">
            @if($movie->poster_path)
                <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" width="270" alt="poster path">
            @endif
                <p>{{ $movie->title }}</p>
                <p>{{ $movie->release_date}}</p>
                <p>{{ $movie->genres ?? 'Sem Generos' }}</p>
        </div>
    @endforeach
</div>

@endsection