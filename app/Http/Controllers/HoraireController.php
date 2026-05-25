<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horaire;
use App\Models\Terrain;

class HoraireController extends Controller
{


    public function index(){
        $horaires = Horaire::with(['terrain', 'reservations'])
            ->where(function ($q) {
                $q->whereDate('date_horaire', '>', now()->toDateString())
                ->orWhere(function ($q2) {
                    $q2->whereDate('date_horaire', now()->toDateString())
                        ->whereTime('heure_debut', '>', now()->format('H:i:s'));
                });
            })
            ->orderBy('date_horaire', 'asc')
            ->orderBy('heure_debut', 'asc')
            ->get();

        return view('horaires.index', compact('horaires'));
    }

    public function create(Request $req){
        $terrains = Terrain::all();

        $selectedTerrain = $req->terrain;
        $selectedHoraire = $req->horaire;

        

        $horairesQuery = Horaire::with('terrain')->whereDoesntHave('reservations', function ($q) {
                $q->whereIn('statut', ['en_attente', 'confirmee']);
            });

        if ($selectedTerrain) {
            $horairesQuery->where('id_terrain', $selectedTerrain);
        }

        $horaires = $horairesQuery->orderBy('date_horaire', 'asc')->orderBy('heure_debut', 'asc')->get();

        return view('horaires.create', compact(
            'terrains',
            'horaires',
            'selectedTerrain',
            'selectedHoraire'
        ));
    }

    public function store(Request $req){
        $req->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        // حذف السوايع اللي دازو
        Horaire::whereDate('date_horaire', '<', now()->toDateString())
            ->orWhere(function ($q) {
                $q->whereDate('date_horaire', now()->toDateString())
                ->whereTime('heure_fin', '<', now()->format('H:i:s'));
            })
            ->delete();

        $terrain_id = $req->id_terrain;
        $date = $req->date;

        $start = strtotime($req->heure_debut);
        $end = strtotime($req->heure_fin);

        $duree = $req->duree * 60;

       while ($start < $end) {

            $heure_debut = date('H:i:s', $start);
            $heure_fin = date('H:i:s', $start + $duree);

            if (($start + $duree) > $end) {
                break;
            }

            $chevauchement = Horaire::where('id_terrain', $terrain_id)
                ->where('date_horaire', $date)
                ->where('heure_debut', '<', $heure_fin)
                ->where('heure_fin', '>', $heure_debut)
                ->exists();

            if (!$chevauchement) {
                Horaire::create([
                    'id_terrain' => $terrain_id,
                    'date_horaire' => $date,
                    'heure_debut' => $heure_debut,
                    'heure_fin' => $heure_fin,
                    'statut' => 'libre'
                ]);
            }

            $start += $duree;
        }

        return redirect()->route('horaires.index')
            ->with('success', __('messages.horaire_ajoute'));
    }

    public function destroy($id){
        $horaire = Horaire::findOrFail($id);

        $horaire->delete();

        return redirect()->back()->with('success', __('messages.horaires_supprimer'));
    }
}