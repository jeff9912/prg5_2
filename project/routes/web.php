<?php

// php -S 127.0.0.1:8000 -t public

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ArtistController::class, 'home'])->name('home');

Route::get('/artist/{id}', [ArtistController::class, 'show'])->name('artist.show');

Route::get('/create', [ArtistController::class, 'create'])->name('artist.create');
Route::post('/artist', [ArtistController::class, 'store'])->name('artist.store');

Route::resource('albums', AlbumController::class);
Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');

Route::get('/about-us', function () {
    $company = 'Jeff Bedrijf';
    return view('about-us', [
        'company' => $company
    ]);
})->name('about');

Route::get('/album', [ArtistController::class, 'album'])->name('albums');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::delete('/artist/{artist}', [ArtistController::class, 'destroy'])->name('artist.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
