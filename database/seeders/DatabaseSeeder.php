<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Lesson;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Lesson::factory()->count(10)->create();
        User::factory()->count(10)->create();
        Group::factory()->count(10)->create();
        University::factory()->count(10)->create();

        $this->call([
            RolesSeeder::class,
        ]);
    }
}
