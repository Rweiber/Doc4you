<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;
use App\Models\Medico;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consulta>
 */
class ConsultaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Consulta::class;
    public function definition(): array
    {
        return [
            'paciente_id' => Paciente::inRandomOrder()->first()->id,
            'medico_id' => Medico::inRandomOrder()->first()->id,
            'data_consulta' => $this->faker->dateTimeBetween('now', '+1 month'), // Data da consulta
            'data_agendamento' => $this->faker->dateTime,
        ];
    }
}
