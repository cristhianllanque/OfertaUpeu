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
        // Modificar la tabla 'ofertas' para agregar las nuevas columnas
        Schema::table('ofertas', function (Blueprint $table) {
            $table->dateTime('fecha_hora_inicio')->nullable();  // Agregar campo para fecha y hora de inicio
            $table->dateTime('fecha_hora_fin')->nullable();     // Agregar campo para fecha y hora de fin
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar las columnas añadidas en caso de rollback
        Schema::table('ofertas', function (Blueprint $table) {
            $table->dropColumn('fecha_hora_inicio');  // Eliminar campo fecha_hora_inicio
            $table->dropColumn('fecha_hora_fin');     // Eliminar campo fecha_hora_fin
        });
    }
};
