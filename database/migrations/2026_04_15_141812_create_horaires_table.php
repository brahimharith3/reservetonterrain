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
        Schema::create('horaires', function (Blueprint $table) {
            $table->id('id_horaire');
            $table->unsignedBigInteger('id_terrain');
            $table->date('date_horaire');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->enum('statut', ['libre', 'reserve'])->default('libre');
            $table->foreign('id_terrain')->references('id_terrain')->on('terrains')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horaires');
    }
};
