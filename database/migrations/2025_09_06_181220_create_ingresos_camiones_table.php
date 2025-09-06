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
    Schema::create('ingresos_camiones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('orden_trabajo_id')->constrained('ordenes_trabajo');
        $table->string('origen');
        $table->string('tipo_carga');
        $table->datetime('fecha_ingreso');
        $table->foreignId('user_id')->constrained('users');
        $table->text('observaciones')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos_camiones');
    }
};
