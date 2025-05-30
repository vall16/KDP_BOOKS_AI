<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sell', function () {
    return view('sell');
})->name('sell');


// ->middleware(['auth', 'verified'])->name('sell');
Route::get('/crea-libro', [BookController::class, 'create'])->name('crea.libro');

// Route::post('/genera-libro', [BookController::class, 'generate'])->name('book.generate');
// Route::post('/book/generate', [BookController::class, 'generate'])->name('book.generate');


Route::get('/crea-libro', [BookController::class, 'create'])->name('book.create');
//creazione del libro ...
Route::post('/genera-libro', [BookController::class, 'generate'])->name('book.generate');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// autenticazione google da Login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/download-book/{id}', [DashboardController::class, 'downloadBook'])->middleware(['auth']);




require __DIR__.'/auth.php';
