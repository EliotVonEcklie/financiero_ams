<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interes>
 */
class InteresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'moratorio' => $this->faker->numberBetween(0, 100),
            'corriente' => $this->faker->numberBetween(0, 100)
        ];
    }
}
