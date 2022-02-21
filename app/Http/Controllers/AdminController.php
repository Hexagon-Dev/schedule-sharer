<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class AdminController extends Controller
{
    public function get(): Response
    {
        return Inertia::render('Admin');
    }

    public function getAllRoles(): JsonResponse
    {
        return response()->json(Role::all());
    }

    public function getRole(int $id): JsonResponse
    {
        $role = Role::query()->findOrFail($id);

        return response()->json($role);
    }

    public function editRole(Request $request, int $id)
    {
        $dataPerms = $request->all();
        $permissions = Permission::all()->toArray();
        dd($permissions, $dataPerms);
        foreach ($dataPerms['permissions'] as $key => $perm) {
            dump($perm);
            if (!is_null($perm)) {
                dump($permissions[$key]);
            }
        }
    }

    public function getAllPermissions(): JsonResponse
    {
        return response()->json(Permission::all());
    }

    public function getRolePermissions(int $id): JsonResponse
    {
        /** @var HasPermissions $role */
        $role = Role::query()->findOrFail($id);

        return response()->json($role->getAllPermissions());
    }

    public function assignRole(Request $request): JsonResponse
    {
        $data = $request->all();

        /** @var HasRoles $user */
        $user = User::query()->where('email', $data['email'])->firstOrFail();

        $user->assignRole($data['role']);

        return response()->json([
            'message' => 'role_assigned'
        ]);
    }

    public function assignPermission(Request $request): JsonResponse
    {
        $data = $request->all();

        /** @var HasPermissions $user */
        $user = User::query()->where('email', $data['email'])->firstOrFail();

        $user->givePermissionTo($data['perm']);

        return response()->json([
            'message' => 'permission_assigned'
        ]);
    }

    public function assignPermissionToRole(Request $request): JsonResponse
    {
        $data = $request->all();

        /** @var HasPermissions $role */
        $role = Role::query()->findOrFail($data['role'])->first();

        $role->givePermissionTo($data['perm']);

        return response()->json([
            'message' => 'permission_assigned'
        ]);
    }
}
