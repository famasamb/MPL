<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_carte_identite',
        'numero_electeur',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'bureau_vote',
    ];

    // Relation avec les parrainages
    public function parrainages()
    {
        return $this->hasMany(Parrainage::class, 'electeur_id');
    }
}
