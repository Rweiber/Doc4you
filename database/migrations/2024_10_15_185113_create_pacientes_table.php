<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->timestamp('data_cadastro')->useCurrent(); 
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('cep');
            $table->string('endereco');
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('numero');
            $table->date('data_nascimento'); 
            $table->string('responsavel_nome')->nullable(); 
            $table->string('responsavel_cpf')->nullable();  
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};

