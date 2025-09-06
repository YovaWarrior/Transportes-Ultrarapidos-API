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
    Schema::create('vales_combustible', function (Blueprint $table) {
        $table->id();
        $table->foreignId('orden_trabajo_id')->constrained('ordenes_trabajo');
        $table->decimal('cantidad_galones', 8, 2);
        $table->datetime('fecha_vale');
        $table->decimal('precio_galon', 6, 2)->nullable();
        $table->decimal('total', 10, 2)->nullable();
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
        Schema::dropIfExists('vales_combustible');
    }
};
