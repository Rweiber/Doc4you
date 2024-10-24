<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable; 

class Medico extends Model implements AuthenticatableContract
{
    /** @use HasFactory<\Database\Factories\MedicoFactory> */
    use HasFactory;

    use Authenticatable;
    // protected $attributes = [
    //     'tipo' => 'medico', // Definindo tipo como 'medico'
    // ];

    protected $fillable = [
        'nome',
        'especialidade_id',
        'crm',
        'email',
        'senha',
    ];
    protected $table = 'medicos';

    /**
     * Obtém a especialidade associada a este médico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function especialidade()
    {
        return $this->belongsTo(Especialidade::class);
    }

    /**
     * Obtém as consultas associadas a este médico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
}
