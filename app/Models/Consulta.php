<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Medico;

class Consulta extends Model
{
    /** @use HasFactory<\Database\Factories\ConsultaFactory> */
    use HasFactory;
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'data_consulta',
        'hora_consulta',
        'status',
    ];

    /**
     * Obtém o paciente associado a esta consulta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    /**
     * Obtém o médico associado a esta consulta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}
