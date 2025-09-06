<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ordenes_trabajo', function (Blueprint $table) {
        $table->id();
        $table->string('numero_orden')->unique();
        $table->foreignId('camion_id')->constrained('camiones');
        $table->foreignId('piloto_id')->constrained('pilotos');
        $table->foreignId('predio_id')->constrained('predios');
        $table->foreignId('bodega_id')->constrained('bodegas');
        $table->enum('estado', ['pendiente', 'en_proceso', 'completada', 'cancelada'])->default('pendiente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_trabajo');
    }
};
