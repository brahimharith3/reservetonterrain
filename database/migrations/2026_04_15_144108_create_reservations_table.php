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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('id_reservation');
            $table->unsignedBigInteger('id_terrain');
            $table->unsignedBigInteger('id_horaire');
            $table->date('date_reservation');
            $table->decimal('montant_total', 8, 2);
            $table->enum('statut', ['en_attente', 'confirmee', 'annulee'])->default('en_attente');
            $table->timestamps();

            $table->foreign('id_terrain')->references('id_terrain')->on('terrains')->onDelete('cascade');
            $table->foreign('id_horaire')->references('id_horaire')->on('horaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
