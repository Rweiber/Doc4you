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
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify(), // Usar a função de faker para CPF
            'data_cadastro' => $this->faker->dateTime(),
            'email' => $this->faker->unique()->safeEmail(),
            'cep' => $this->faker->postcode(),
            'endereco' => $this->faker->address(),
            'numero' => $this->faker->buildingNumber(),
            'bairro' => $this->faker->streetName(), // Adicionar bairro
            'cidade' => $this->faker->city(),       // Adicionar cidade
            'uf' => $this->faker->stateAbbr(),       // Adicionar UF
            'data_nascimento' => $this->faker->date(),
        ];
    }

}
