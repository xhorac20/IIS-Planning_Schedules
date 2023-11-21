<?php

namespace Database\Factories;

use App\Models\EducationalActivities;
use App\Models\Rooms;
use App\Models\Schedules;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchedulesFactory extends Factory
{
    protected $model = Schedules::class;

    public function definition()
    {
        return [
            'educational_activity_id' => EducationalActivities::factory(),
            'room_id' => Rooms::factory(),
            'instructor_id' => User::factory(),
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time,
        ];
    }
}
