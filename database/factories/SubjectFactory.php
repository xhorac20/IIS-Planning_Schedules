<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('SUB##'),
            'name' => $this->faker->words(3, true),
            'annotation' => $this->faker->sentence,
            'credits' => $this->faker->numberBetween(1, 10),
            'guarantor_id' => User::factory(),
        ];
    }
}
