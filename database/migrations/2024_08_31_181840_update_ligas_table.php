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
        Schema::table('ligas', function (Blueprint $table) {
            // Eliminar el campo user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Eliminar el campo reglas
            $table->dropColumn('reglas');

            // Agregar el campo max_users
            $table->integer('max_users')->default(10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligas', function (Blueprint $table) {
            // Restaurar el campo user_id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Restaurar el campo reglas
            $table->text('reglas');

            // Eliminar el campo max_users
            $table->dropColumn('max_users');
        });
    }
};
