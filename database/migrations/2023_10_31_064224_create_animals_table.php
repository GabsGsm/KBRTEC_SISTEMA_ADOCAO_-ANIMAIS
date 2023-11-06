<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('animais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('especie');
            $table->string('raca');
            $table->integer('idade');
            $table->decimal('peso', 10, 2);
            $table->string('porte');
            $table->string('local');
            $table->text('descricao')->nullable();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->timestamps();

            $table->unique(['nome', 'especie', 'idade']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
