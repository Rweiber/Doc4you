<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paciente extends Model implements AuthenticatableContract
{
    /** @use HasFactory<\Database\Factories\PacienteFactory> */
    use HasFactory, Authenticatable;

    protected $attributes = [
        'tipo' => 'paciente', // Definindo tipo como 'paciente'
    ];

    protected $table = 'pacientes';

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
