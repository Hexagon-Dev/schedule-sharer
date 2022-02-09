<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUniversityRequest;
use App\Models\University;
use Illuminate\Http\JsonResponse;

class UniversityController extends Controller
{
    public function getOne(int $id): JsonResponse
    {
        $university = University::query()->findOrFail($id);
        $groups = $university->groups()->get()->toArray();

        $data = $university->toArray();
        $data['groups'] = $groups;

        return response()->json($data);
    }

    public function getAll(): JsonResponse
    {
        return response()->json(University::all());
    }

    public function create(CreateUniversityRequest $request): JsonResponse
    {
        return response()->json(University::query()->create($request->validated()));
    }

    public function delete(int $id): JsonResponse
    {
        University::query()->find($id)->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}
