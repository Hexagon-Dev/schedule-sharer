<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $permissions = [
            'schedule_view',
            'schedule_create',
            'schedule_edit',
            'schedule_delete',
            'lesson_view',
            'lesson_create',
            'lesson_edit',
            'lesson_delete',
            'type_view',
            'type_create',
            'type_edit',
            'type_delete',
            'university_view',
            'university_create',
            'university_edit',
            'university_delete',
            'group_view',
            'group_create',
            'group_edit',
            'group_delete',
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        Role::create(['name' => 'headman']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'rector']);

        $admin_role = Role::create(['name' => 'admin']);
        $admin->assignRole($admin_role);
    }
}
