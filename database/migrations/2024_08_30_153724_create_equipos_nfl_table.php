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
        Schema::create('equipos_nfl', function (Blueprint $table) {

            $table->unsignedBigInteger('id')->primary(); // Usa bigInteger y marca como primary

            $table->string('ciudad');
            $table->string('nombre');
            $table->string('nombre_completo');
            $table->string('conferencia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_nfl');
    }
};
