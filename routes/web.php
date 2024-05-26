<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ChirpLikeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('chirps', [ChirpController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('chirps'); 

Route::post('chirps/{chirp}/like', [ChirpLikeController::class, 'like' ])
    ->middleware('auth')->name('chirps.like');

Route::post('chirps/{chirp}/unlike', [ChirpLikeController::class, 'unlike' ])
    ->middleware('auth')->name('chirps.unlike');

require __DIR__.'/auth.php';
