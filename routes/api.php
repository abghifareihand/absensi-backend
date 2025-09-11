<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AttendancePointController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // 🔑 AUTH
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/update-fcm-token', [AuthController::class, 'updateFcmToken']);

    // 📅 Schedule
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show']);

    // 📍 Attendance Points
    Route::get('/attendance-points', [AttendancePointController::class, 'index']);
    Route::get('/attendance-points/{attendancePoint}', [AttendancePointController::class, 'show']);

    // ⚙️ Settings
    Route::get('/settings/{key}', [SettingController::class, 'show']);

    // 📝 Attendance
    Route::get('/attendances', [AttendanceController::class, 'index']);
    Route::get('/attendances/{attendance}', [AttendanceController::class, 'show']);
    Route::post('/attendances', [AttendanceController::class, 'store']);

    // 🎉 Events
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
});
