<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class UniversityFactory extends Factory
{
    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(10) . ' University',
            'description' => $this->faker->text(),
        ];
    }
}
