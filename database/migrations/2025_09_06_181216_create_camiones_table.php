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
    Schema::create('camiones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('transportista_id')->constrained('transportistas');
        $table->string('placa')->unique();
        $table->string('tipo');
        $table->decimal('capacidad', 8, 2);
        $table->enum('estado', ['activo', 'mantenimiento', 'fuera_servicio'])->default('activo');
        $table->integer('año')->nullable();
        $table->string('marca')->nullable();
        $table->string('modelo')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camiones');
    }
};
