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

        $defaultRole = Role::create(['name' => 'default']);
        Role::create(['name' => 'headman'])->save();
        Role::create(['name' => 'teacher'])->save();
        Role::create(['name' => 'unverified_teacher'])->save();
        Role::create(['name' => 'rector'])->save();

        $defaultRole->givePermissionTo('schedule_edit');
        $defaultRole->givePermissionTo('schedule_view');

        $admin_role = Role::create(['name' => 'admin']);
        $admin->assignRole($admin_role);
    }
}
