<?php

namespace Database\Factories;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomsFactory extends Factory
{
    protected $model = Rooms::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'location' => $this->faker->address,
            'capacity' => $this->faker->numberBetween(10, 100),
        ];
    }
}
