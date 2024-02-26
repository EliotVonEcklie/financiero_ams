<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PredioPropietario>
 */
class PredioPropietarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'orden' => 1,
            'tipo_documento' => 'C',
            'documento' => $this->faker->randomNumber(10),
            'nombre_propietario' => $this->faker->name
        ];
    }
}
