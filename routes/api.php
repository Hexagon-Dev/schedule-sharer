<?php

use App\Http\Controllers\GroupController;
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
