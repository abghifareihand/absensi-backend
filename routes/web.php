<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttendancePointController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Login & Logout
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // ================= DASHBOARD =================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ================= USERS =================
    Route::prefix('users')->group(function () {
        // STAFF
        Route::get('/staff', [UserController::class, 'staffIndex'])->name('users.staff.index');
        Route::get('/staff/create', [UserController::class, 'staffCreate'])->name('users.staff.create');
        Route::post('/staff', [UserController::class, 'staffStore'])->name('users.staff.store');
        Route::get('/staff/{id}/edit', [UserController::class, 'staffEdit'])->name('users.staff.edit');
        Route::put('/staff/{id}', [UserController::class, 'staffUpdate'])->name('users.staff.update');
        Route::delete('/staff/{id}', [UserController::class, 'staffDestroy'])->name('users.staff.destroy');

        // DOSEN
        Route::get('/dosen', [UserController::class, 'dosenIndex'])->name('users.dosen.index');
        Route::get('/dosen/create', [UserController::class, 'dosenCreate'])->name('users.dosen.create');
        Route::post('/dosen', [UserController::class, 'dosenStore'])->name('users.dosen.store');
        Route::get('/dosen/{id}/edit', [UserController::class, 'dosenEdit'])->name('users.dosen.edit');
        Route::put('/dosen/{id}', [UserController::class, 'dosenUpdate'])->name('users.dosen.update');
        Route::delete('/dosen/{id}', [UserController::class, 'dosenDestroy'])->name('users.dosen.destroy');

        // MAHASIWA
        Route::get('/mahasiswa', [UserController::class, 'mahasiswaIndex'])->name('users.mahasiswa.index');
        Route::get('/mahasiswa/create', [UserController::class, 'mahasiswaCreate'])->name('users.mahasiswa.create');
        Route::post('/mahasiswa', [UserController::class, 'mahasiswaStore'])->name('users.mahasiswa.store');
        Route::get('/mahasiswa/{id}/edit', [UserController::class, 'mahasiswaEdit'])->name('users.mahasiswa.edit');
        Route::put('/mahasiswa/{id}', [UserController::class, 'mahasiswaUpdate'])->name('users.mahasiswa.update');
        Route::delete('/mahasiswa/{id}', [UserController::class, 'mahasiswaDestroy'])->name('users.mahasiswa.destroy');
    });


    // ================= SSCHEDULE =================
    Route::prefix('schedules')->group(function () {
        // STAFF
        Route::get('/staff', [ScheduleController::class, 'staffIndex'])->name('schedules.staff.index');
        Route::get('/staff/{id}', [ScheduleController::class, 'staffShow'])->name('schedules.staff.show');
        Route::get('/staff/{id}/create', [ScheduleController::class, 'staffCreate'])->name('schedules.staff.create');
        Route::post('/staff/{id}', [ScheduleController::class, 'staffStore'])->name('schedules.staff.store');
        Route::get('/staff/{id}/edit/{scheduleId}', [ScheduleController::class, 'staffEdit'])->name('schedules.staff.edit');
        Route::put('/staff/{id}/update/{scheduleId}', [ScheduleController::class, 'staffUpdate'])->name('schedules.staff.update');
        Route::delete('/staff/{id}/destroy/{scheduleId}', [ScheduleController::class, 'staffDestroy'])->name('schedules.staff.destroy');

        // DOSEN
        Route::get('/dosen', [ScheduleController::class, 'dosenIndex'])->name('schedules.dosen.index');
        Route::get('/dosen/{id}', [ScheduleController::class, 'dosenShow'])->name('schedules.dosen.show');
        Route::get('/dosen/{id}/create', [ScheduleController::class, 'dosenCreate'])->name('schedules.dosen.create');
        Route::post('/dosen/{id}', [ScheduleController::class, 'dosenStore'])->name('schedules.dosen.store');
        Route::get('/dosen/{id}/edit/{scheduleId}', [ScheduleController::class, 'dosenEdit'])->name('schedules.dosen.edit');
        Route::put('/dosen/{id}/update/{scheduleId}', [ScheduleController::class, 'dosenUpdate'])->name('schedules.dosen.update');
        Route::delete('/dosen/{id}/destroy/{scheduleId}', [ScheduleController::class, 'dosenDestroy'])->name('schedules.dosen.destroy');

        // MAHASISSWA
        Route::get('/mahasiswa', [ScheduleController::class, 'mahasiswaIndex'])->name('schedules.mahasiswa.index');
        Route::get('/mahasiswa/{id}', [ScheduleController::class, 'mahasiswaShow'])->name('schedules.mahasiswa.show');
        Route::get('/mahasiswa/{id}/create', [ScheduleController::class, 'mahasiswaCreate'])->name('schedules.mahasiswa.create');
        Route::post('/mahasiswa/{id}', [ScheduleController::class, 'mahasiswaStore'])->name('schedules.mahasiswa.store');
        Route::get('/mahasiswa/{id}/edit/{scheduleId}', [ScheduleController::class, 'mahasiswaEdit'])->name('schedules.mahasiswa.edit');
        Route::put('/mahasiswa/{id}/update/{scheduleId}', [ScheduleController::class, 'mahasiswaUpdate'])->name('schedules.mahasiswa.update');
        Route::delete('/mahasiswa/{id}/destroy/{scheduleId}', [ScheduleController::class, 'mahasiswaDestroy'])->name('schedules.mahasiswa.destroy');
    });

    // ================= ATTENDANCE POINT =================
    Route::prefix('points')->group(function () {
        Route::get('/', [AttendancePointController::class, 'index'])->name('points.index');
        Route::get('/create', [AttendancePointController::class, 'create'])->name('points.create');
        Route::post('/store', [AttendancePointController::class, 'store'])->name('points.store');
        Route::get('/{id}/edit', [AttendancePointController::class, 'edit'])->name('points.edit');
        Route::put('/{id}', [AttendancePointController::class, 'update'])->name('points.update');
        Route::delete('/{id}', [AttendancePointController::class, 'destroy'])->name('points.destroy');
    });

    // ================= SETTINGS =================
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/create', [SettingController::class, 'create'])->name('settings.create');
        Route::post('/store', [SettingController::class, 'store'])->name('settings.store');
        Route::get('/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/{id}', [SettingController::class, 'update'])->name('settings.update');
        Route::delete('/{id}', [SettingController::class, 'destroy'])->name('settings.destroy');
    });

    // ================= EVENTS =================
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/store', [EventController::class, 'store'])->name('events.store');
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/{id}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    });


});
