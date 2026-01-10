@extends('layouts.main')


@section('content')

@php
    $movieDesc = $movies->first();
    use Illuminate\Support\Str;
    
@endphp

<div class="Cartaz">

    <div class="bg-image" style="background-image: url('https://image.tmdb.org/t/p/w500{{ $movieDesc->backdrop_path }}');">
    <h2>{{ $movieDesc->title }}</h2>
    <p>{{ Str::limit( $movieDesc->overview , 150, '...') }}</p>
        <button class="btn-op">Dar opinião</button>
    </div>

</div>






<h2>Populares</h2>
<div class="cards">
    @foreach ( $movies as $movie )
        <div class="card" onclick="window.location='{{ route('movies.show', $movie->id) }}'">
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