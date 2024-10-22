<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Especialidade;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Especialidade>
 */
class EspecialidadeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Especialidade::class;
    public function definition(): array
    {
        // Lista de especialidades
        $especialidades = [
            "Cardiologia",
            "Pediatria",
            "Dermatologia",
            "Neurologia",
            "Ortopedia",
            "Ginecologia",
            "Oftalmologia",
            "Psiquiatria",
            "Urologia",
            "Endocrinologia",
            "Gastroenterologia",
            "Oncologia",
            "Reumatologia",
            "Anestesiologia",
            "Medicina do Trabalho",
            "Pneumologia",
            "Infectologia",
            "Cirurgia Geral",
            "Cirurgia Plástica",
            "Otorrinolaringologia",
            "Radiologia",
            "Medicina de Família",
            "Nutrição",
            "Fisioterapia",
            "Acupuntura",
            "Homeopatia",
            "Medicina Esportiva",
            "Genética Médica",
            "Hematologia",
            "Transplante de Órgãos",
            "Medicina Intensiva",
            "Pediatria Cardíaca",
            "Geriatria",
            "Nefrologia",
            "Alergologia",
            "Toxicologia",
            "Pediatria Geral",
            "Patologia",
            "Medicina Legal",
            "Saúde Pública",
            "Medicina de Emergência",
            "Pediatria Oncológica",
            "Medicina Paliativa",
            "Cardiologia Pediátrica",
            "Medicina do Sono",
            "Dermatologia Estética",
            "Reabilitação"
        ];

        return [
            'nome' => $this->faker->unique()->randomElement($especialidades),
        ];
    }

}
