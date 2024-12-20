<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id(); // ID principal del jugador, que será auto-incremental.

            $table->string('nombre'); // Campo para el nombre del jugador.
            $table->string('apellido'); // Campo para el apellido del jugador.
            $table->unsignedBigInteger('equipo_nfl_id')->nullable(); // ID del equipo NFL al que pertenece.
            $table->unsignedBigInteger('equipo_id')->nullable(); // ID del equipo al que pertenece.
            $table->string('posicion');// Cambiado a string para manejar el texto
            $table->decimal('puntos_fantasy', 8, 2)->default(0); // Campo para los puntos de fantasy.

            $table->timestamps(); // Campos created_at y updated_at para controlar cuándo se crean y actualizan los registros.

            // Relacionar con la tabla equipos
            $table->foreign('equipo_nfl_id')
                ->references('id')
                ->on('equipos_nfl')
                ->onDelete('set null');

            // Relacionar con la tabla equipos
            $table->foreign('equipo_id')
                ->references('id')
                ->on('equipos')
                ->onDelete('set null');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jugadores', function (Blueprint $table) {
            $table->dropForeign(['equipo_id']);
        });

        Schema::dropIfExists('jugadores');
    }
};
