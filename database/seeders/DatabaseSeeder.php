<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Consulta;
use App\Models\Telefone;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
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

        // Criar especialidades
        foreach ($especialidades as $nome) {
            Especialidade::create(['nome' => $nome]);
        }

        // Criar médicos reutilizando especialidades existentes
        // Medico::factory(50)->make()->each(function ($medico) use ($especialidades) {
        //     $medico->especialidade_id = $especialidades->random()->id;
        //     $medico->save();
        // });

        // Criar pacientes
        // $pacientes = Paciente::factory()->count(100)->create();

        // Criar telefones reutilizando pacientes existentes
        // Telefone::factory(100)->create();

        // Criar consultas reutilizando pacientes e médicos existentes
        // Consulta::factory(100)->create();
    }
}
