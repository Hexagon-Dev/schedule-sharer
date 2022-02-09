<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function getOne(int $id): JsonResponse
    {
        return response()->json(User::query()->findOrFail($id)->toArray());
    }
}
