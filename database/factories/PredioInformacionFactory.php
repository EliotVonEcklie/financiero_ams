<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PredioInformacion>
 */
class PredioInformacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo_destino_economico_id' => 1,
            'direccion' => $this->faker->address,
            'hectareas' => $this->faker->randomNumber(4),
            'metros_cuadrados' => $this->faker->randomNumber(6),
            'area_construida' => $this->faker->randomNumber(3),
            'predio_tipo_id' => $this->faker->numberBetween(1, 2)
        ];
    }
}
