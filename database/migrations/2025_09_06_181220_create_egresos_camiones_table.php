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
    Schema::create('egresos_camiones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('orden_trabajo_id')->constrained('ordenes_trabajo');
        $table->string('destino');
        $table->string('tipo_carga');
        $table->datetime('fecha_egreso');
        $table->foreignId('user_id')->constrained('users');
        $table->integer('kilometraje')->nullable();
        $table->text('observaciones')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresos_camiones');
    }
};
