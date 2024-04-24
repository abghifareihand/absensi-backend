<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');
    Route::get('profile', function () {
        return view('pages.profile');
    })->name('profile');

    Route::resource('user', UserController::class);
});
