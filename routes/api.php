<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/group/{id}', [GroupController::class, 'getOne']);
Route::get('/group', [GroupController::class, 'getAll']);
Route::post('/group', [GroupController::class, 'create']);
Route::delete('/group', [GroupController::class, 'delete']);

Route::get('/university/{id}', [UniversityController::class, 'getOne']);
Route::get('/university', [UniversityController::class, 'getAll']);
Route::post('/university', [UniversityController::class, 'create']);
Route::delete('/university', [UniversityController::class, 'delete']);

Route::get('/user/{id}', [UserController::class, 'getOne']);

Route::get('/lesson', [LessonController::class, 'getAll'])->name('api.lesson.all');

Route::get('/user/group/{role}', [UserController::class, 'getRole'])->name('api.user.group');

Route::get('/type', [TypeController::class, 'getAll'])->name('api.type.all');
Route::put('/type', [TypeController::class, 'create'])->name('api.type.create');
