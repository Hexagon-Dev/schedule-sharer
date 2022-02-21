<?php

use App\Http\Controllers\AdminController;
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
        Route::get('/schedule', [ScheduleController::class, 'getAll'])->name('api.schedule.all');
        Route::put('/schedule', [ScheduleController::class, 'add'])->name('api.schedule.add');

        Route::middleware('only.admin')->group(function () {
            Route::get('/admin/role', [AdminController::class, 'getAllRoles'])->name('api.admin.role.all');
            Route::get('/admin/role/{id}', [AdminController::class, 'getRole'])->name('api.admin.role.get');
            Route::post('/admin/role/{id}', [AdminController::class, 'editRole'])->name('api.admin.role.edit');
            Route::get('/admin/permission', [AdminController::class, 'getAllPermissions'])->name('api.admin.permission.all');
            Route::get('/admin/permission/role/{id}', [AdminController::class, 'getRolePermissions'])->name('api.admin.permission.role');
            Route::put('/admin/role/assign', [AdminController::class, 'assignRole'])->name('api.admin.role.assign');
            Route::put('/admin/permission/assign', [AdminController::class, 'assignPermission'])->name('api.admin.permission.assign');
            Route::put('/admin/permission/assign/role', [AdminController::class, 'assignPermissionToRole'])->name('api.admin.permission.assign.role');
        });
    });

    Route::get('/schedule', static function () {
        return Inertia::render('Schedule');
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

    Route::middleware('only.admin')->group(function () {
        Route::get('/admin', static function () {
            return Inertia::render('Admin');
        })->name('admin');
        Route::get('/admin/role', static function () {
            return Inertia::render('Admin/Role');
        })->name('admin.role');
        Route::get('/admin/role/{id}', static function ($id) {
            return Inertia::render('Admin/RoleOne', ['id' => $id]);
        })->name('admin.role.one');
    });
});
