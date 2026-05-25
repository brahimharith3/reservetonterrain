<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Terrain;
use App\Models\Horaire;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmationMail;

class ReservationController extends Controller
{
    public function index(){
        $reservations = Reservation::where('user_id', Auth::id())->with('terrain', 'horaire')->latest()->get();

        return view('reservations.index', compact('reservations'));
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

        return view('reservations.create', compact(
            'terrains',
            'horaires',
            'selectedTerrain',
            'selectedHoraire'
        ));
    }

   public function store(Request $req){
        $req->validate([
            'id_terrain' => 'required',
            'id_horaire' => 'required',
            'montant_total' => 'required|numeric'
        ]);

        $dejaReserve = Reservation::where('id_horaire', $req->id_horaire)->whereIn('statut', ['en_attente', 'confirmee'])->exists();

        if ($dejaReserve) {
            return redirect()->back()->withInput()->with('error', __('messages.horaire_deja_reserve'));
        }

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'id_terrain' => $req->id_terrain,
            'id_horaire' => $req->id_horaire,
            'date_reservation' => now()->toDateString(),
            'montant_total' => $req->montant_total,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('reservations.index')->with('success', __('messages.reservation_demande'));
    }

    public function annuler($id){
        $reservation = Reservation::where('id_reservation', $id)->where('user_id', Auth::id())->firstOrFail();

        $reservation->update([
            'statut' => 'annulee'
        ]);

        $reservation->horaire->update([
            'statut' => 'libre'
        ]);

        return redirect()->route('reservations.index');
    }

    // public function adminIndex(){
    //     $reservations = Reservation::with('user', 'terrain', 'horaire')->get();

    //     return view('reservations.admin_index', compact('reservations'));
    // }

    public function adminIndex(){

        $reservations = Reservation::with('user', 'terrain', 'horaire')->latest()->get();

        return view('reservations.admin_index', compact('reservations'));
    }

    public function confirmer($id){
        $reservation = Reservation::with('user', 'terrain', 'horaire')->where('id_reservation', $id)->firstOrFail();

        $reservation->statut = 'confirmee';
        $reservation->save();

        // Mail::to($reservation->user->email)
        //     ->send(new ReservationConfirmationMail($reservation));

        try {
            Mail::to($reservation->user->email)
                ->send(new ReservationConfirmationMail($reservation));
        } 
        catch (\Exception $e) {
            return redirect()->route('admin.reservations')
                ->with('success', __('messages.Réservation_confirmée'))
                ->with('warning', 'Réservation confirmée mais email non envoyé.');
        }

        return redirect()->route('admin.reservations')
            ->with('success', __('messages.Réservation_confirmée'));
    }
    
    public function adminAnnuler($id){
        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'statut' => 'annulee'
        ]);
        
        //horaire libre
        $reservation->horaire->update([
            'statut' => 'libre'
        ]);

        // return redirect()->route('admin.reservations');
        return redirect()->route('admin.reservations')->with('success', __('messages.Réservation_annulée'));
    }

    public function destroy($id){
        $reservation = Reservation::findOrFail($id);

        $reservation->delete();

        return redirect()->back()->with('success',__('messages.Réservation_supprimée'));
    }


    public function downloadPdf($id){
        $reservation = Reservation::with('terrain', 'horaire', 'user')->where('id_reservation', $id)->where('user_id', auth()->id())->firstOrFail();

        $pdf = Pdf::loadView('reservations.pdf', compact('reservation'));

        return $pdf->download('reservation_'.$reservation->id_reservation.'.pdf');
    }
}
