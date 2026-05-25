<?php

namespace Database\Seeders;

use App\Models\Terrain;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        Terrain::factory(10)->create();

        $this->call([TerrainSeeder::class,]);
        $this->call([HoraireSeeder::class,]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test1@example.com',
        ]);
    }
}
