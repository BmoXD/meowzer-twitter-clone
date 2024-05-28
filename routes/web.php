<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ChirpLikeController;
use App\Http\Controllers\ChirpCommentController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::view('profile', 'profile')a
//     ->middleware(['auth'])
//     ->name('profile');

Route::get('chirps', [ChirpController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('chirps'); 

Route::post('chirps/{chirp}/like', [ChirpLikeController::class, 'like' ])
    ->middleware('auth')->name('chirps.like');

Route::post('chirps/{chirp}/unlike', [ChirpLikeController::class, 'unlike' ])
    ->middleware('auth')->name('chirps.unlike');

Route::post('chirps/{chirp}/comments', [ChirpCommentController::class, 'store' ])
    ->name('chirps.comments.store');
    

Route::resource('users', UserController::class)->only('show', 'edit', 'update')
    ->middleware('auth');

Route::post('users/{user}/follow', [UserController::class, 'follow'])
    ->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [UserController::class, 'unfollow'])
    ->middleware('auth')->name('users.unfollow');


Route::get('profile', [UserController::class, 'profile'])
    ->middleware('auth')->name('profile');

Route::get('chirps', [ChirpController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('chirps');


require __DIR__.'/auth.php';
