<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estatuto>
 */
class EstatutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'vigencia_desde' => now()->year,
            'vigencia_hasta' => now()->addYear()->year,
            'norma_predial' => $this->faker->boolean,
            'bomberil' => $this->faker->boolean,
            'bomberil_predial' => $this->faker->boolean,
            'bomberil_tarifa' => $this->faker->boolean,
            'bomberil_tasa' => $this->faker->randomNumber(3),
            'ambiental' => $this->faker->boolean,
            'ambiental_predial' => $this->faker->boolean,
            'ambiental_tarifa' => $this->faker->boolean,
            'ambiental_tasa' => $this->faker->randomNumber(3),
            'alumbrado' => $this->faker->boolean,
            'alumbrado_urbano' => $this->faker->boolean,
            'alumbrado_rural' => $this->faker->boolean,
            'alumbrado_tarifa' => $this->faker->boolean,
            'alumbrado_tasa' => $this->faker->randomNumber(3),
            'recibo_caja' => $this->faker->randomNumber(4, true)
        ];
    }
}
