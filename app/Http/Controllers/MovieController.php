<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
Movie::updateOrCreate(
    ['tmdb_id' => $request->tmdb_id],
    [
        'title' => $request->title,
        'overview' => $request->overview,
        'poster_path' => $request->poster_path ?? '',
        'backdrop_path' => $request->backdrop_path ?? '',
        'release_date' => $request->release_date ?? null,
        'rating' => $request->rating ?? 0,
        'genres' => $request->genre_names ?? '', 
    ]
);

        return redirect()->route('movies.index')->with('success', 'Filme adicionado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $movie->update($request->all());

    return redirect()->route('movies.index')
        ->with('success', 'Filme atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
       $movie->delete();

    return redirect()->route('movies.index')
        ->with('success', 'Filme removido!');
    }

    public function search(Request $request){

    
 $response = Http::get(
        config('services.tmdb.url') . '/search/movie',
        [
            'api_key' => config('services.tmdb.key'),
            'query' => $request->query('query'),
            'language' => 'pt-BR',
        ]
    );
      $genreMap = [
        28  => 'Ação',
        12  => 'Aventura',
        16  => 'Animação',
        35  => 'Comédia',
        80  => 'Crime',
        99  => 'Documentário',
        18  => 'Drama',
        10751 => 'Família',
        14  => 'Fantasia',
        36  => 'História',
        27  => 'Terror',
        10402 => 'Música',
        9648 => 'Mistério',
        10749 => 'Romance',
        878 => 'Ficção Científica',
        10770 => 'Cinema TV',
        53  => 'Suspense',
        10752 => 'Guerra',
        37  => 'Faroeste'
    ];

    $movies = collect($response->json('results') ?? [])->map(function($movie) use ($genreMap) {
        $movie['genre_names'] = [];

        if (isset($movie['genre_ids']) && is_array($movie['genre_ids'])) {
            foreach($movie['genre_ids'] as $id) {
                if (isset($genreMap[$id])) {
                    $movie['genre_names'][] = $genreMap[$id];
                }
            }
        }

        // Proteger os  campos opcionais
        // $movie['poster_path'] = $movie['poster_path'] ?? '';
        // $movie['overview'] = $movie['overview'] ?? '';
        // $movie['release_date'] = $movie['release_date'] ?? '';
        // $movie['vote_average'] = $movie['vote_average'] ?? 0;

        return $movie;
    });

    // dd($response->json());
    

    return view('movies.search', compact('movies'));
    }
}
