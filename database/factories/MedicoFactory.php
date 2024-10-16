<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Especialidade;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medico>
 */
class MedicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Medico::class;
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name, // Nome completo do médico
            'crm' => $this->faker->unique()->numerify('CRM####'), // CRM único
            'especialidade_id' => Especialidade::inRandomOrder()->first()->id,
        ];
    }
}
