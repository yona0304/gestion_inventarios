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
            $table->float('valor_contratado',15,2);
            $table->string('ubicacion');
            $table->foreignId('usuario_id')->constrained('users');
            $table->date('fecha_inicio_alquiler');
            $table->date('fecha_fin_alquiler')->nullable();
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
