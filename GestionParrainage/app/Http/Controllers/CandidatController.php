<?php

// app/Http/Controllers/CandidatController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;

class CandidatController extends Controller
{

    public function evolution()
    {
        // Récupérer les données des candidats et leurs parrainages
        $candidats = Candidat::with('parrainages')->get();

        // Préparer les données pour le graphique
        $labels = [];
        $data = [];
        foreach ($candidats as $candidat) {
            $labels[] = $candidat->nom;
            $data[] = $candidat->parrainages->count();
        }

        // Passer les données à la vue
        return view('candidats.evolution', [
            'labels' => $labels,
            'data' => $data,
        ]);
    }
    
    public function create()
    {
        return view('enregistrer-candidat');
    }
    public function store(Request $request)
    {
        $request->validate([
            'numero_electeur' => 'required|unique:candidats',
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required|date',
            'email' => 'required|email|unique:candidats',
            'telephone' => 'required|unique:candidats',
        ]);

        $candidat = Candidat::create($request->all());

        // Générer un code de sécurité
        $code = rand(10000, 99999);
        // Envoyer le code par email et SMS (à implémenter)

        return redirect()->back()->with('success', 'Candidat enregistré avec succès.');
    }

    public function show($id)
    {
        $candidat = Candidat::findOrFail($id);
        $parrainages = $candidat->parrainages()->with('electeur')->get();

        return view('suivi-parrainages', compact('candidat', 'parrainages'));
    }
}
