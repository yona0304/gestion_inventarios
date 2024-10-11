<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        //
        Schema::create('dotacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cargo');  // Definir el campo como clave foránea
            $table->unsignedBigInteger('id_activo'); // Definir el campo como clave foránea
            $table->timestamps();
            // Definir las relaciones con las otras tablas
            $table->foreign('id_cargo')->references('id')->on('cargos');
            $table->foreign('id_activo')->references('id')->on('categorias');
        });
    }

    public function down(): void
    {
        //
        Schema::dropIfExists('dotacion');
    }
};
