<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // get user
    Route::get('user', [AuthController::class, 'get']);

    // update user
    Route::put('user', [AuthController::class, 'update']);

    // update profile
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    // logout
    Route::post('logout', [AuthController::class, 'logout']);

    // get company
    Route::get('company', [CompanyController::class, 'get']);

    // check in
    Route::post('checkin', [AttendanceController::class, 'checkIn']);

    // check out
    Route::post('checkout', [AttendanceController::class, 'checkOut']);

    // is chekedin
    Route::get('is-checkin', [AttendanceController::class, 'isCheckedin']);
});


// register
Route::post('register', [AuthController::class, 'register']);

// login
Route::post('login', [AuthController::class, 'login']);
