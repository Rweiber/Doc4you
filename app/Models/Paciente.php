<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    /** @use HasFactory<\Database\Factories\PacienteFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'numero',
        'data_nascimento',
        'responsavel_nome',
        'responsavel_cpf',
    ];
        public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    
}
