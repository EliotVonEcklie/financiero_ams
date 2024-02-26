<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PredioAvaluo>
 */
class PredioAvaluoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vigencia' => now()->year,
            'valor_avaluo' => $this->faker->numberBetween(1_000_000),
            'tasa_por_mil' => $this->faker->numberBetween(2, 33)
        ];
    }
}
