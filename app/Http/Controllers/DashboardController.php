<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terrain;
use App\Models\Horaire;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;



class DashboardController extends Controller
{
    public function index()
    {
        $terrains = Terrain::count();
        // $horaires = Horaire::count();
        $horaires = Horaire::where(function ($q) {
            $q->whereDate('date_horaire', '>', now()->toDateString())
            ->orWhere(function ($q2) {
                $q2->whereDate('date_horaire', now()->toDateString())
                    ->whereTime('heure_debut', '>', now()->format('H:i:s'));
            });
        })->count();
        $reservations = Reservation::count();
        $resertodays = Reservation::whereDate('created_at', today())->count();
        $terrains_libre = Horaire::where(function ($q) {
            $q->whereDate('date_horaire', '>', now()->toDateString())->orWhere(function ($q2) {
                $q2->whereDate('date_horaire', now()->toDateString())
                    ->whereTime('heure_debut', '>', now()->format('H:i:s'));
            });
        })->where('statut', 'libre')->distinct()->count('id_terrain');

        $confirmees = Reservation::where('statut','confirmee')->count();
        $en_attente = Reservation::where('statut','en_attente')->count();
        $annulees = Reservation::where('statut','annulee')->count();
        $utilisateurs = User::where('role', 'client')->count();
        // $terrains_libre = Horaire::where('statut','libre')->distinct()->count('id_terrain');
        $jours = request('jours', 30);
        $totalRevenus = Reservation::where('statut', 'confirmee')->whereDate('created_at', '>=', Carbon::now()->subDays($jours))
        ->sum('montant_total');

        $derniers_utilisateurs = User::where('role', 'client')->latest()->take(5)->get();

        $pieData = [$confirmees,$en_attente,$annulees];

        $reservationsParJour = Reservation::selectRaw('WEEKDAY(created_at) as jour, COUNT(*) as total')->groupBy('jour')->pluck('total', 'jour')->toArray();

        $reservationsData = [];                         

        for ($i = 0; $i < 7; $i++) {
            $reservationsData[] = $reservationsParJour[$i] ?? 0;
        }

        return view('dashboard', compact(
            'terrains',
            'horaires',
            'reservations',
            'confirmees',
            'en_attente',
            'annulees',
            'utilisateurs',
            'resertodays',
            'terrains_libre',
            'pieData',
            'reservationsData',
            'totalRevenus',
            'jours',
            'derniers_utilisateurs'
        ));
    }

    public function downloadBilanPdf(Request $request){
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $dateDebut = $request->date_debut;
        $dateFin = $request->date_fin;

        $reservationsQuery = Reservation::whereBetween('created_at', [
            $dateDebut . ' 00:00:00',
            $dateFin . ' 23:59:59'
        ]);

        $reservations = (clone $reservationsQuery)->count();

        $confirmees = (clone $reservationsQuery)->where('statut', 'confirmee')->count();

        $en_attente = (clone $reservationsQuery)->where('statut', 'en_attente')->count();

        $annulees = (clone $reservationsQuery)->where('statut', 'annulee')->count();

        $totalRevenus = (clone $reservationsQuery)->where('statut', 'confirmee')->sum('montant_total');

        $terrains = Terrain::count();
        $horaires = Horaire::count();
        $utilisateurs = User::where('role', 'client')->count();

        $pdf = Pdf::loadView('dashboard.bilan_pdf', compact(
            'dateDebut',
            'dateFin',
            'terrains',
            'horaires',
            'utilisateurs',
            'reservations',
            'confirmees',
            'en_attente',
            'annulees',
            'totalRevenus'
        ));

        return $pdf->download('bilan_'.$dateDebut.'_au_'.$dateFin.'.pdf');
    
    }



}