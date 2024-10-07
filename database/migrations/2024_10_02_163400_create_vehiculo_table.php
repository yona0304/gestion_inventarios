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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('color', 50);
            $table->string('llave', 100);
            $table->string('terpel');
            $table->string('placa', 60);
            $table->string('descripcion_vehiculo', 300);
            $table->string('traccion', 80);
            $table->string('modelo', 80);
            $table->string('proveedor_contratante');
            $table->string('tipo_proveedor');
            $table->decimal('valor_contratado', 40);
            $table->date('fecha_entregaProveedor');
            $table->date('fecha_devolucionProveedor')->nullable();
            $table->string('estado', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
