<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ChirpLikeController;
use App\Http\Controllers\ChirpCommentController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('meows', [ChirpController::class, 'index'])
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

Route::get('users/{user}/followings', [UserController::class, 'followings'])
    ->middleware('auth')->name('users.followings');
Route::get('users/{user}/followers', [UserController::class, 'followers'])
    ->middleware('auth')->name('users.followers');

    
    
Route::get('profile', [UserController::class, 'profile'])
    ->middleware('auth')->name('profile');


require __DIR__.'/auth.php';
