<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // get user
    Route::get('user', [AuthController::class, 'get']);

    // update user
    Route::put('user', [AuthController::class, 'update']);

    // logout
    Route::post('logout', [AuthController::class, 'logout']);

    // get company
    Route::get('company', [CompanyController::class, 'get']);
});


// register
Route::post('register', [AuthController::class, 'register']);

// login
Route::post('login', [AuthController::class, 'login']);
