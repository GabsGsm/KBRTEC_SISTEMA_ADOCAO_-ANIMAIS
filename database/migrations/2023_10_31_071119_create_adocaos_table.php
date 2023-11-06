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
        Schema::create('adocaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained('animais');
            $table->string('nome_solicitante');
            $table->string('cpf');
            $table->string('email');
            $table->string('celular');
            $table->date('data_nascimento');
            $table->timestamp('data_envio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    
    {
        Schema::dropIfExists('adocaos');
    }
};
