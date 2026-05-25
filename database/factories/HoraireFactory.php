<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Terrain;

class HoraireFactory extends Factory
{
    public function definition(): array
    {
        $startHour = fake()->numberBetween(8, 22);

        return [
            'id_terrain' => Terrain::inRandomOrder()->first()->id_terrain,
            'date_horaire' => fake()->dateTimeBetween('now', '+15 days')->format('Y-m-d'),
            'heure_debut' => sprintf('%02d:00:00', $startHour),
            'heure_fin' => sprintf('%02d:00:00', $startHour + 1),
            'statut' => 'libre',
        ];
    }
}