<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Terrain;
use App\Models\Horaire;
use Carbon\Carbon;

class HoraireSeeder extends Seeder
{
    public function run(): void
    {
        $terrains = Terrain::all();

        foreach ($terrains as $terrain) {

            for ($day = 0; $day < 7; $day++) {

                $date = Carbon::today()->addDays($day)->format('Y-m-d');

                $creneaux = [
                    ['09:00:00', '10:00:00'],
                    ['10:00:00', '11:00:00'],
                    ['11:00:00', '12:00:00'],
                    ['15:00:00', '16:00:00'],
                    ['16:00:00', '17:00:00'],
                    ['17:00:00', '18:00:00'],
                    ['18:00:00', '19:00:00'],
                    ['19:00:00', '20:00:00'],
                    ['20:00:00', '21:00:00'],
                    ['21:00:00', '22:00:00'],
                ];

                foreach ($creneaux as $creneau) {
                    Horaire::firstOrCreate([
                        'id_terrain' => $terrain->id_terrain,
                        'date_horaire' => $date,
                        'heure_debut' => $creneau[0],
                        'heure_fin' => $creneau[1],
                    ], [
                        'statut' => 'libre',
                    ]);
                }
            }
        }
    }
}