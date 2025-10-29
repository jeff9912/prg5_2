<?php

// php -S 127.0.0.1:8000 -t public

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ArtistController::class, 'home'])->name('home');

//filter route, met filter functie
Route::get('/artist/filter', [ArtistController::class, 'filter'])->name('artist.filter');
Route::get('/search', [ArtistController::class, 'search'])->name('artist.search');
Route::get('/artist/{id}', [ArtistController::class, 'show'])->name('artist.show');
Route::get('/create', [ArtistController::class, 'create'])->name('artist.create');
Route::post('/artist', [ArtistController::class, 'store'])->name('artist.store');


//form voor hidden
Route::patch('/artist/{artist}/toggle-hidden', [ArtistController::class, 'toggleHidden'])->name('artist.toggleHidden');
//form voor delete
Route::delete('/artist/{artist}', [ArtistController::class, 'destroy'])->name('artist.destroy');
//filter by genre (doesnt work yet)
//edit entries
Route::get('/artist/{artist}/edit', [ArtistController::class, 'edit'])->name('artist.edit');
//update edited entries
Route::put('/artist/{artist}', [ArtistController::class, 'update'])->name('artist.update');

Route::resource('albums', AlbumController::class);
Route::get('/album', [ArtistController::class, 'album'])->name('albums');
Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');

Route::get('/about-us', function () {
    $company = 'Jeff Bedrijf';
    return view('about-us', [
        'company' => $company
    ]);
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
