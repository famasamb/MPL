<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parrain;

class ParrainController extends Controller
{
    public function create()
    {
        return view('creer-compte');
    }
    public function store(Request $request)
    {
        $request->validate([
            'numero_electeur' => 'required|exists:electeurs,numero_electeur',
            'cin' => 'required|exists:electeurs,numero_carte_identite',
            'nom' => 'required',
            'bureau_vote' => 'required',
            'telephone' => 'required|unique:parrains',
            'email' => 'required|email|unique:parrains',
        ]);

        $parrain = Parrain::create($request->all());

        // Envoyer un code d'authentification
        $code = rand(10000, 99999);
        // Envoyer le code par email et SMS (à implémenter)

        return redirect()->back()->with('success', 'Compte créé avec succès.');
    }
}
