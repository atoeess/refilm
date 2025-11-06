<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserFilmController;
use App\Http\Controllers\HighlightController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


//route resource for products


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/film/{slug}', [UserFilmController::class, 'show'])->name('film.detail');
    Route::get('/genre/{id}', [FilmController::class, 'showByGenre'])->name('genre.film');
    Route::get('/negara/{id}', [FilmController::class, 'showByNegara'])->name('negara.film');

});
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
    Route::get('/genre/tambah-genre', [GenreController::class, 'create'])->name('genre.create');
    Route::post('/genre/store-genre', [GenreController::class, 'store'])->name('genre.store');
    Route::get('/genre/{id}/edit', [GenreController::class, 'edit'])->name('genre.edit');
    Route::put('/genre/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/genre/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');

    Route::get('/film', [FilmController::class, 'index'])->name('film.index');
    Route::get('/film/create', [FilmController::class, 'create'])->name('film.create');
    Route::post('/film/store', [FilmController::class, 'store'])->name('film.store');
    Route::get('/film/{id}/edit', [FilmController::class, 'edit'])->name('film.edit');
    Route::put('/film/{id}', [FilmController::class, 'update'])->name('film.update');
    Route::delete('/film/{id}', [FilmController::class, 'destroy'])->name('film.destroy');

    Route::get('/negara', [NegaraController::class, 'index'])->name('negara.index');
    Route::get('/negara/tambah-negara', [NegaraController::class, 'create'])->name('negara.create');
    Route::post('/negara/store-negara', [NegaraController::class, 'store'])->name('negara.store');
    Route::get('/negara/{id}/edit', [NegaraController::class, 'edit'])->name('negara.edit');
    Route::put('/negara/{id}', [NegaraController::class, 'update'])->name('negara.update');
    Route::delete('/negara/{id}', [NegaraController::class, 'destroy'])->name('negara.destroy');

    Route::get('/highlight', [HighlightController::class, 'index'])->name('highlight.index');
    Route::get('/highlight/create', [HighlightController::class, 'create'])->name('highlight.create');
    Route::post('/highlight/store', [HighlightController::class, 'store'])->name('highlight.store');
    Route::get('/highlight/{id}/edit', [HighlightController::class, 'edit'])->name('highlight.edit');
    Route::put('/highlight/{id}', [HighlightController::class, 'update'])->name('highlight.update');
    Route::delete('/highlight/{id}', [HighlightController::class, 'destroy'])->name('highlight.destroy');

    Route::resource('product', ProductController::class);


    Route::post('/logout', function () {
        // Auth::logout();
        return redirect('/login');
    })->name('logout');
});
