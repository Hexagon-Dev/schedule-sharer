<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\JsonResponse;

class TypeController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(Type::all());
    }
}
