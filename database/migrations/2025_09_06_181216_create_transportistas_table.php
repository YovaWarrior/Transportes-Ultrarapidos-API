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
    Schema::create('transportistas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->enum('tipo', ['empresa', 'independiente']);
        $table->string('nit')->nullable();
        $table->string('telefono')->nullable();
        $table->text('direccion')->nullable();
        $table->string('email')->nullable();
        $table->boolean('active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportistas');
    }
};
