<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 40, 100),
            'calories' =>$this->faker->numberBetween(1500, 3500),
            'exercise_time' =>$this->faker->time,
            'exercise_content' =>$this->faker->sentence()
        ];
    }
}
