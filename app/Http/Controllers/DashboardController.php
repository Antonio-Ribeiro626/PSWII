<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
 public function index()
    {
        $user = Auth::user();

        return view('dashboard', [
            'movies' => $user->role === 'admin'
                ? Movie::latest()->get()
                : collect(),

            'comments' => $user->role !== 'admin'
                ? Comment::with('movie')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get()
                : collect(),
        ]);
    }
}
