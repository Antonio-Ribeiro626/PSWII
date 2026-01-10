@extends('layouts.main')


@section('content')
        
    <div class="bg-image" style="background-image: url('https://image.tmdb.org/t/p/w500{{ $movie->backdrop_path }}'); height: 300px; background-position: unset;"></div>
        <h2>{{ $movie->title }}</h2>
        <p>{{ $movie->overview }}</p>
        <p><strong>Gêneros:</strong> {{ $movie->genres ?? 'Sem Generos' }}</p>
        <p>Data de lançamento: {{ $movie->release_date }}</p>
   


@endsection