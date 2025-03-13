<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_electeur',
        'nom',
        'prenom',
        'date_naissance',
        'email',
        'telephone',
        'parti_politique',
        'slogan',
        'photo',
        'couleurs_parti',
        'url_page',
    ];

    // Relation avec les parrainages
    public function parrainages()
    {
        return $this->hasMany(Parrainage::class, 'candidat_id');
    }
}
