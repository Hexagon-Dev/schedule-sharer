<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class TypeFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(10),
        ];
    }
}
