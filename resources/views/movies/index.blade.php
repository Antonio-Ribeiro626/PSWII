@extends('layouts.main')


@section('content')

@php
    $movieDesc = $movies->first();
    
@endphp

<div class="Cartaz">
    <h2>{{ $movieDesc->title }}</h2>
    <p>{{ $movieDesc->overview }}</p>
    <img src="https://image.tmdb.org/t/p/w500{{ $movieDesc->backdrop_path }}" alt="" srcset="">
</div>



<h2>Populares</h2>
<div class="cards">
    @foreach ( $movies as $movie )
        <div class="card">
            @if($movie->poster_path)
                <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}"  alt="poster path">
            @endif
                <div class="text-card">
                    <h3>{{ $movie->title }}</h3>
                    <p>{{ $movie->genres ?? 'Sem Generos' }}</p>
                    <p>{{ $movie->release_date}}</p>
                </div>
         
        </div>
    @endforeach
</div>

@endsection