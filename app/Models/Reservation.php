<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Terrain;
use App\Models\Horaire;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id_reservation';

    protected $fillable = [
        'user_id',
        'id_terrain',
        'id_horaire',
        'date_reservation',
        'montant_total',
        'statut',
        'admin_seen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class, 'id_terrain');
    }

    public function horaire()
    {
        return $this->belongsTo(Horaire::class, 'id_horaire');
    }
}