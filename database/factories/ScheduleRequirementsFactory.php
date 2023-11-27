<?php

namespace Database\Factories;

use App\Models\ScheduleRequirement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleRequirementsFactory extends Factory
{
    protected $model = ScheduleRequirement::class;

    public function definition(): array
    {
        return [
            'instructor_id' => User::factory(),
            'day' => $this->faker->randomElement(['monday', 'tuesday', 'wednesday', 'thursday', 'friday']),
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time,
        ];
    }
}
