<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Terrain extends Model
{
    use HasFactory;
    
    protected $table = 'terrains';
    protected $primaryKey = 'id_terrain';
    protected $fillable = [
        'nom_terrain',
        'type_terrain',
        'localisation',
        'prix_heure',
        'description',
        'image',
        'google_maps_embed',
        'google_maps_link'
    ];

    public function horaires(){
        return $this->hasMany(Horaire::class, 'id_terrain');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class, 'id_terrain');
    }
}
