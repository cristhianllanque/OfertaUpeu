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
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');

            $table->decimal('salario', 8, 2);
            $table->string('ubicacion');
            // Nuevas columnas para programar la oferta
            $table->dateTime('fecha_hora_inicio')->nullable(); // Permite que el campo sea opcional
            $table->dateTime('fecha_hora_fin')->nullable(); // Permite que el campo sea opcional

            $table->date('fecha_vencimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
