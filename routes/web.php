<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', static function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware('inertia')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/schedule/{day}', [ScheduleController::class, 'get'])->name('api.schedule.get.day');
        Route::put('/schedule', [ScheduleController::class, 'add'])->name('api.schedule.add');
    });

    Route::get('/schedule', static function (Request $request) {
        $permissions = $request->user()->getAllPermissions();

        return Inertia::render('Schedule', ['permissions' => $permissions]);
    })->name('schedule');

    Route::get('/schedule/add', static function () {
        return Inertia::render('AddSchedule');
    })->name('schedule.add');

    Route::get('/schedule/delete', static function () {
        return Inertia::render('Schedule');
    })->name('schedule.delete');

    Route::get('/type', static function () {
        return Inertia::render('Type');
    })->name('type');

    Route::get('/teacher', static function () {
        return Inertia::render('Teacher');
    })->name('teacher');

    Route::get('/teacher/add', static function () {
        return Inertia::render('Teacher');
    })->name('teacher.add');

    Route::get('/teacher/delete', static function () {
        return Inertia::render('Teacher');
    })->name('teacher.delete');

    Route::get('/user/{id}', static function ($id) {
        return Inertia::render('User', ['user_id' => $id]);
    })->name('user');
});
