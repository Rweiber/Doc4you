<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    /** @use HasFactory<\Database\Factories\TelefoneFactory> */
    use HasFactory;

    protected $fillable = [
        'paciente_id', 'numero'
    ];

    /**
     * Obtém o paciente associado a este telefone.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }


}
