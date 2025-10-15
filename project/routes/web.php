<?php

// php -S 127.0.0.1:8000 -t public

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about-us', function () {
    $company = 'Jeff Bedrijf';
    return view('about-us', [
        'company' => $company
    ]);
})->name('about');

Route::get('shop/{name}', function (string $name) {
    $product = [
        'id' => 1,
        'name' => $name
    ];
    return view('products', ['product' => $product]);

})->name('adidas');

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
