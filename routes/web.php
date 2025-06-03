<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StripeController;



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
// Route::get('/crea-libro', [BookController::class, 'create'])->name('crea.libro');
Route::get('/crea-libro', [BookController::class, 'create'])->name('book.create');
//creazione del libro ...
Route::post('/genera-libro', [BookController::class, 'generate'])->name('book.generate');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// autenticazione google da Login
// Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/download-book/{id}', [DashboardController::class, 'downloadBook'])->middleware(['auth']);
// Per web.php (attenzione a middleware auth)
Route::get('/api/books/{id}', [DashboardController::class, 'getBookDetails'])
    ->middleware('auth');

//flusso stripe...
Route::post('/book/start-checkout', [BookController::class, 'startCheckout'])->name('book.startCheckout');
Route::get('/stripe/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::get('/book/complete', [BookController::class, 'complete'])->name('book.complete');
Route::get('/book/cancel', function () {
    return redirect()->route('book.create')->withErrors('Pagamento annullato.');
})->name('book.cancel');




require __DIR__.'/auth.php';
