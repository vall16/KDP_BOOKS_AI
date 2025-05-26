<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
	return view('landing');
});
Route::get('/sell', [SellController::class, 'index'])->name('sell');
Route::get('/login', [SellController::class, 'index'])->name('login');
Route::get('/register', [SellController::class, 'index'])->name('register');

