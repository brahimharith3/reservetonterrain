<?php

namespace Database\Seeders;

use App\Models\Terrain;
use Illuminate\Database\Seeder;

class TerrainSeeder extends Seeder
{
    public function run(): void
    {
        Terrain::factory()->count(5)->create();
    }
}