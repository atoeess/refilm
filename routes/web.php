<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\ProfileController;

// ----------------------------------------------------
// 🔹 HALAMAN PUBLIK
// ----------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/film/{slug}', [FilmController::class, 'show'])->name('film.detail');
Route::get('/search', [FilmController::class, 'search'])->name('film.search');
Route::get('/genre/{id}', [FilmController::class, 'showByGenre'])->name('genre.film');
Route::get('/negara/{id}', [FilmController::class, 'showByNegara'])->name('negara.film');
Route::post('/film/rating', [FilmController::class, 'rating'])->name('film.rating');
Route::get('/genre/{id}', [FilmController::class, 'byGenre'])->name('genre.film');
Route::get('/negara/{id}', [FilmController::class, 'bynegara'])->name('negara.film');
Route::get('/tahun/{tahun}', [FilmController::class, 'byTahun'])->name('tahun.film');
Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');
Route::get('/rekomendasi', [HomeController::class, 'rekomendasi'])->name('rekomendasi');
Route::get('/series/{slug}', [FilmController::class, 'seriesPage'])->name('film.series');



// toggle favorite
Route::post('/favorite/toggle', [FavoriteController::class, 'toggle'])
    ->name('favorite.toggle');

// halaman daftar favorit
Route::get('/favorite', [FavoriteController::class, 'index'])
    ->name('favorite.index');

    Route::delete('/favorite/{id}', [FavoriteController::class, 'remove'])
    ->name('favorite.remove');




// ----------------------------------------------------
// 🔹 AUTH (Hanya untuk tamu yang belum login)
// ----------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware(['auth'])->group(function () {
    Route::post('post-komen', [KomentarController::class, 'store'])->name('komen.post');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komen.delete');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

// ----------------------------------------------------
// 🔹 LOGOUT (Bisa diakses hanya jika login)
// ----------------------------------------------------
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------------------------------------------
// 🔹 ADMIN (auth + is_admin middleware)
// ----------------------------------------------------
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Genre
    Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
    Route::get('/genre/tambah-genre', [GenreController::class, 'create'])->name('genre.create');
    Route::post('/genre/store-genre', [GenreController::class, 'store'])->name('genre.store');
    Route::get('/genre/{id}/edit', [GenreController::class, 'edit'])->name('genre.edit');
    Route::put('/genre/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/genre/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');

    // Film
    Route::get('/film', [FilmController::class, 'index'])->name('film.index');
    Route::get('/film/create', [FilmController::class, 'create'])->name('film.create');
    Route::post('/film/store', [FilmController::class, 'store'])->name('film.store');
    Route::get('/film/{id}/edit', [FilmController::class, 'edit'])->name('film.edit');
    Route::put('/film/{id}', [FilmController::class, 'update'])->name('film.update');
    Route::delete('/film/{id}', [FilmController::class, 'destroy'])->name('film.destroy');
    Route::get('/film/{id}', [FilmController::class, 'show'])->name('film.show');

    // Negara
    Route::get('/negara', [NegaraController::class, 'index'])->name('negara.index');
    Route::get('/negara/tambah-negara', [NegaraController::class, 'create'])->name('negara.create');
    Route::post('/negara/store-negara', [NegaraController::class, 'store'])->name('negara.store');
    Route::get('/negara/{id}/edit', [NegaraController::class, 'edit'])->name('negara.edit');
    Route::put('/negara/{id}', [NegaraController::class, 'update'])->name('negara.update');
    Route::delete('/negara/{id}', [NegaraController::class, 'destroy'])->name('negara.destroy');

    // Highlight
    Route::get('/highlight', [HighlightController::class, 'index'])->name('highlight.index');
    Route::get('/highlight/create', [HighlightController::class, 'create'])->name('highlight.create');
    Route::post('/highlight/store', [HighlightController::class, 'store'])->name('highlight.store');
    Route::get('/highlight/{id}/edit', [HighlightController::class, 'edit'])->name('highlight.edit');
    Route::put('/highlight/{id}', [HighlightController::class, 'update'])->name('highlight.update');
    Route::delete('/highlight/{id}', [HighlightController::class, 'destroy'])->name('highlight.destroy');

    //Tahun
    Route::get('/tahun', [TahunController::class, 'index'])->name('tahun.index');
    Route::get('/tahun/create', [TahunController::class, 'create'])->name('tahun.create');
    Route::post('/tahun/store', [TahunController::class, 'store'])->name('tahun.store');
    Route::get('/tahun/{id}/edit', [TahunController::class, 'edit'])->name('tahun.edit');
    Route::put('/tahun/{id}', [TahunController::class, 'update'])->name('tahun.update');
    Route::delete('/tahun/{id}', [TahunController::class, 'destroy'])->name('tahun.destroy');

    // Menu Rating Admin
    Route::get('/rating', [RatingController::class, 'index'])->name('rating.index');
    Route::get('/rating/{film_id}', [RatingController::class, 'show'])->name('rating.show');

    //komentar
    Route::get('/komentar', [KomentarController::class, 'index'])->name('komentar.index');
    Route::get('/komentar/{id_film}', [KomentarController::class, 'show'])->name('komentar.show');




    // Produk
    Route::resource('product', ProductController::class);

    // Route::get('/403', function () {
    //     return view('errors.403');
    // })->name('errors.403');

    // ak@mbleyer.com
});
