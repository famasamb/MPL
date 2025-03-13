<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parrainage extends Model
{
    use HasFactory;

    protected $fillable = [
        'electeur_id',
        'candidat_id',
        'code_authentification',
    ];

    // Relation avec l'électeur
    public function electeur()
    {
        return $this->belongsTo(Electeur::class, 'electeur_id');
    }

    // Relation avec le candidat
    public function candidat()
    {
        return $this->belongsTo(Candidat::class, 'candidat_id');
    }
}
