<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Telefone>
 */
class TelefoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Telefone::class;
    public function definition(): array
    {
        return [
            'paciente_id' => Paciente::inRandomOrder()->first()->id, 
            'numero' => $this->faker->phoneNumber,
        ];
    }
}
