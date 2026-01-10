<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
     'tmdb_id',
        'title',
        'overview',
        'poster_path',
        'backdrop_path',
        'genres',
        'release_date',
        'rating',
    ];
}
