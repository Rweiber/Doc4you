<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Paciente::class;
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name, // Nome completo do paciente
            'cpf' => $this->faker->unique()->numerify('###.###.###-##'), // CPF único
            'data_cadastro' => $this->faker->dateTime, // Data de cadastro
            'email' => $this->faker->unique()->safeEmail, // E-mail único
            'cep' => $this->faker->postcode, // CEP
            'endereco' => $this->faker->address, // Endereço completo
            'numero' => $this->faker->buildingNumber,
        ];
    }
}
