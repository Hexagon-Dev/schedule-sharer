<?php

namespace Database\Factories;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class GroupFactory extends Factory
{
    /**
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        return [
            'name' => Str::random(10),
            'university_id' => random_int(1, 10),
        ];
    }
}
