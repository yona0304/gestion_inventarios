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
        Schema::create('historial_computo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos');
            $table->string('marca', 100)->nullable();
            $table->string('modelo', 150)->nullable();
            $table->string('hostname')->nullable();
            $table->string('t_equipo')->nullable();
            $table->string('serial')->nullable();
            $table->string('procesador')->nullable();
            $table->string('disco', 150)->nullable();
            $table->string('ram', 150)->nullable();
            $table->string('s_instalado', 180)->nullable();
            $table->string('licencias')->nullable();
            $table->string('s_operativo')->nullable();
            $table->string('licencia')->nullable();
            $table->string('antivirus')->nullable();
            $table->string('version_licencia')->nullable();
            $table->text('observaciones')->nullable();
            $table->date('fecha_registro')->nullable();
            // $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_computo');
    }
};
