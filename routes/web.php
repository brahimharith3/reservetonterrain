<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\HoraireController;
use App\Http\Controllers\ReservationController;
use App\Models\Terrain;
use App\Models\Horaire;
use App\Models\Reservation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'ar'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::middleware(['auth', 'admin'])->group(function () {

    // Route::get('/dashboard', function () {

    //     $terrains = Terrain::count();
    //     $horaires = Horaire::count();
    //     $reservations = Reservation::count();

    //     $confirmes = Reservation::where('statut','confirmee')->count();
    //     $attente = Reservation::where('statut','en_attente')->count();
    //     $annulees = Reservation::where('statut','annulee')->count();

    //     return view('dashboard', compact(
    //         'terrains',
    //         'horaires',
    //         'reservations',
    //         'confirmes',
    //         'attente',
    //         'annulees'
    //     ));

    // })->name('dashboard');


    Route::get('/dashboard/bilan/pdf', [DashboardController::class, 'downloadBilanPdf'])->name('dashboard.bilan.pdf');
  

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin/reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations');

    Route::get('/admin/reservation/confirmer/{id}', [ReservationController::class, 'confirmer'])
        ->name('reservation.confirmer');

    Route::get('/admin/reservation/annuler/{id}', [ReservationController::class, 'adminAnnuler'])
        ->name('reservation.admin.annuler');

    Route::get('/admin/terrains', [TerrainController::class, 'index'])->name('terrains.index');
    Route::get('/admin/terrain/create', [TerrainController::class, 'create'])->name('terrain.create');
    Route::post('/admin/terrain/store', [TerrainController::class, 'store'])->name('terrain.store');
    Route::get('/admin/terrain/edit/{id}', [TerrainController::class, 'edit'])->name('terrain.edit');
    Route::post('/admin/terrain/update/{id}', [TerrainController::class, 'update'])->name('terrain.update');
    Route::get('/admin/terrain/delete/{id}', [TerrainController::class, 'delete'])->name('terrain.delete');

    Route::get('/horaires', [HoraireController::class, 'index'])->name('horaires.index');
    Route::get('/horaire/create', [HoraireController::class, 'create'])->name('horaire.create');
    Route::post('/horaire/store', [HoraireController::class, 'store'])->name('horaire.store');
    Route::delete('/horaires/{id}',[HoraireController::class, 'destroy'])->name('horaires.destroy');




});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
    Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/reservation/annuler/{id}', [ReservationController::class, 'annuler'])->name('reservation.annuler');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // page home client login
    Route::get('/home', [TerrainController::class, 'home'])->name('home')->middleware('auth');

    // page terrain clickable pour les clien
    Route::get('/terrain/{id}', [TerrainController::class, 'show'])->name('terrain.show');
    
    Route::get('/reservation/pdf/{id}', [ReservationController::class, 'downloadPdf'])->name('reservation.pdf')->middleware('auth');



});

require __DIR__.'/auth.php';