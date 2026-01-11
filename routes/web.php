<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;


// Home / Filmes
Route::get('/', [MovieController::class, 'index']);
Route::get('movies/search', [MovieController::class, 'search'])->name('movies.search');
Route::resource('movies', MovieController::class);

// Páginas estáticas
Route::get('/about', function () {
    return view('about');
});
Route::get('/saiba-mais', function () {
    return view('saiba-mais');
});
Route::post('/movies/{movie}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

// Dashboard padrão (para todos os users autenticados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas de perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Route (painel do admin)
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acesso negado');
        }
        return view('dashboard');
    })->name('admin.dashboard');


});

require __DIR__ . '/auth.php';
