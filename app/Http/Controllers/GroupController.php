<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Models\Group;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    public function getOne(int $id): JsonResponse
    {
        $group = Group::query()->findOrFail($id);

        $users = $group->users()->get()->toArray();

        $data = $group->toArray();

        $data['users'] = $users;

        return response()->json($data);
    }

    public function getAll(): JsonResponse
    {
        return response()->json(Group::all());
    }

    public function create(CreateGroupRequest $request): JsonResponse
    {
        return response()->json(Group::query()->create($request->validated()));
    }

    public function delete(int $id): JsonResponse
    {
        Group::query()->find($id)->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}
