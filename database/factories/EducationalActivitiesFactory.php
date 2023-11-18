<?php

namespace Database\Factories;

use App\Models\EducationalActivities;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationalActivitiesFactory extends Factory
{
    protected $model = EducationalActivities::class;

    public function definition(): array
    {
        return [
            'subject_id' => Subject::factory(),
            'type' => $this->faker->randomElement(['Přednáška', 'Cvičení']),
            'duration' => $this->faker->numberBetween(1, 4),
            'repetition' => $this->faker->randomElement(['každý týden', 'sudý týden', 'lichý týden', 'jednorázově']),
        ];
    }
}
