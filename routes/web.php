<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UrlController::class, 'index'])->name('home');
Route::post('/shorten', [UrlController::class, 'shorten'])->name('shorten');
Route::get('/{shortcode}', [UrlController::class, 'redirect'])->name('redirect');