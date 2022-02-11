<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(Type::all());
    }

    public function create(Request $request): JsonResponse
    {
        Type::query()->create(['name' => $request->get('name')]);

        return response()->json([
            'message' => 'type_created'
        ]);
    }
}
