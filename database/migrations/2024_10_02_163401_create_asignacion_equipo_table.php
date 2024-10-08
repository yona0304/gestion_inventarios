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
        Schema::create('asignacion_equipo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->nullable()->constrained('productos');
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos');
            $table->foreignId('usuario_id')->constrained('users');
            $table->date('fecha_asignacion');
            $table->text('observaciones')->nullable();
            $table->string('estado');
            $table->string('ubicacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_equipo');
    }
};
