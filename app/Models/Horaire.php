<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Horaire extends Model
{
    use HasFactory;
    protected $table = 'horaires';
    protected $primaryKey = 'id_horaire';

    protected $fillable = [
        'id_terrain',
        'date_horaire',
        'heure_debut',
        'heure_fin',
        'statut'
    ];

    public function terrain(){
        return $this->belongsTo(Terrain::class, 'id_terrain', 'id_terrain');
    }


    public function reservations(){
        return $this->hasMany(Reservation::class, 'id_horaire');
    }
}
