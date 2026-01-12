<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'movies' => Movie::all(),
        ]);
    }
}
