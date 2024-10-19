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
        // Criar especialidades
        $especialidades = Especialidade::factory()->count(47)->create();

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
