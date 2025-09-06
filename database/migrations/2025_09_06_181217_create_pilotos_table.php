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
    Schema::create('pilotos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('transportista_id')->constrained('transportistas');
        $table->string('nombre');
        $table->string('licencia')->unique();
        $table->string('telefono')->nullable();
        $table->string('dpi')->nullable();
        $table->boolean('active')->default(true);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilotos');
    }
};
