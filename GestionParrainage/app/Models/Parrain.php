<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parrain extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_electeur',
        'cin',
        'nom',
        'bureau_vote',
        'telephone',
        'email',
        'code_authentification',
    ];

    // Relation avec les parrainages
    public function parrainages()
    {
        return $this->hasMany(Parrainage::class, 'electeur_id');
    }
}
