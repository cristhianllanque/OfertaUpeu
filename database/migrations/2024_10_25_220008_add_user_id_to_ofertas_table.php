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
        Schema::table('ofertas', function (Blueprint $table) {
            // Verificar si la columna 'user_id' no existe antes de intentar añadirla
            if (!Schema::hasColumn('ofertas', 'user_id')) {
                // Agregar la columna user_id y establecerla como clave foránea
                $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ofertas', function (Blueprint $table) {
            // Verificar si la columna existe antes de eliminarla
            if (Schema::hasColumn('ofertas', 'user_id')) {
                // Eliminar la clave foránea y la columna user_id
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
