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
        Schema::create('alquiler_equipo', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_producto');
            $table->string('producto');
            $table->integer('valor_contratado');
            $table->foreignId('usuario_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquiler_equipo');
    }
};
