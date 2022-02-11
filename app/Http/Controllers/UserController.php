<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOne(int $id): JsonResponse
    {
        return response()->json(User::query()->findOrFail($id));
    }

    /**
     * @param string $role
     * @return JsonResponse
     */
    public function getRole(string $role): JsonResponse
    {
        return response()->json(User::role($role)->get());
    }
}
