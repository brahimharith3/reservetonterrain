<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TerrainFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom_terrain' => fake()->company(),
            'type_terrain' => fake()->randomElement([
            'Football',
            'Basketball',
            'Tennis'
            ]),
            'localisation' => fake()->city(),
            'prix_heure' => fake()->numberBetween(100, 500),
            'description' => fake()->sentence(),
            'image' => 'terrain.jpg',
            'google_maps_link' => 'https://maps.google.com'
        ];
    }
}