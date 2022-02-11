<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/group/{id}', [GroupController::class, 'getOne'])->name('api.group.one');
Route::get('/group', [GroupController::class, 'getAll'])->name('api.group.all');
Route::post('/group', [GroupController::class, 'create'])->name('api.group.create');
Route::delete('/group', [GroupController::class, 'delete'])->name('api.group.delete');

Route::get('/university/{id}', [UniversityController::class, 'getOne'])->name('api.university.one');
Route::get('/university', [UniversityController::class, 'getAll'])->name('api.university.all');
Route::post('/university', [UniversityController::class, 'create'])->name('api.university.create');
Route::delete('/university', [UniversityController::class, 'delete'])->name('api.university.delete');

Route::get('/user/{id}', [UserController::class, 'getOne'])->name('api.user.one');
Route::get('/user/group/{role}', [UserController::class, 'getRole'])->name('api.user.group');

Route::get('/lesson', [LessonController::class, 'getAll'])->name('api.lesson.all');

Route::get('/type', [TypeController::class, 'getAll'])->name('api.type.all');
Route::put('/type', [TypeController::class, 'create'])->name('api.type.create');

Route::get('/post', [PostController::class, 'getAll'])->name('api.post.all');
