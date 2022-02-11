<?php

namespace Database\Factories;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ScheduleFactory extends Factory
{
    /**
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'lesson_id' => random_int(0, 10),
            'day' => random_int(1, 7),
            'group_id' => random_int(1, 10),
            'classroom' => 1,
            'building' => 1,
            'type_id' => random_int(1, 5),
            'start_time' => random_int(8, 14) . ':00',
            'end_time' => random_int(9, 15) . ':00',
            'week_num' => 0,
        ];
    }
}
