<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Traits\HasRoles;

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

    public function createTeacher(CreateTeacherRequest $request): JsonResponse
    {
        $data = $request->validated();

        /** @var HasRoles $user */
        $user = User::query()->create($data);

        $user->assignRole('unverified_teacher');

        return response()->json([
            'message' => 'teacher_created'
        ]);
    }
}
