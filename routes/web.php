<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    GoogleController,
    BookController,
    DashboardController,
    StripeController
};


// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Pagina di vendita pubblica: SCELTA PACCHETTO
Route::view('/sell', 'sell')->name('sell');
//pagina gestione errori...
Route::view('/error', 'error')->name('error');


Route::get('/crea-libro', [BookController::class, 'create'])->name('book.create');
//generazione del libro da BE
// Route::post('/genera-libro', [BookController::class, 'generate'])->name('book.generate');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
//questa route di call back è chiamata da google socialite
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


//flusso stripe...
Route::get('/stripe/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');

// condizioni di vendita
Route::view('/condizioni-di-vendita', 'condizioni')->name('condizioni');



// Dashboard (protetta)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/download-book/{id}', [DashboardController::class, 'downloadBook']);
    Route::get('/api/books/{id}', [DashboardController::class, 'getBookDetails']);
});


Route::post('/book/start-checkout', [BookController::class, 'startCheckout'])->name('book.startCheckout');
// Route::get('/book/complete', [BookController::class, 'complete'])->name('book.complete');

Route::get('/book/complete', [BookController::class, 'complete2'])->name('book.complete2');
// errore nel pagamento
Route::get('/book/cancel', function () {
    return redirect()->route('book.create')->withErrors('Pagamento annullato.');
})->name('book.cancel');





require __DIR__.'/auth.php';
