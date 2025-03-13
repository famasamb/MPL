<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parrain;
use App\Models\Parrainage;

class ParrainageController extends Controller
{

    public function statistiques()
    {
        // Récupérer les données des parrainages
        $parrainages = Parrainage::with('candidat')->get();

        // Préparer les données pour le graphique
        $labels = [];
        $data = [];
        foreach ($parrainages as $parrainage) {
            $labels[] = $parrainage->candidat->nom;
            $data[] = $parrainage->count();
        }

        // Passer les données à la vue
        return view('parrainages.statistiques', [
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('enregistrer-parrainage');
    }
    public function store(Request $request)
    {
        $request->validate([
            'numero_electeur' => 'required|exists:electeurs,numero_electeur',
            'cin' => 'required|exists:electeurs,numero_carte_identite',
            'code_authentification' => 'required',
        ]);

        // Vérifier le code d'authentification
        $parrain = Parrain::where('numero_electeur', $request->input('numero_electeur'))
            ->where('code_authentification', $request->input('code_authentification'))
            ->first();

        if (!$parrain) {
            return redirect()->back()->with('error', 'Code d\'authentification invalide.');
        }

        // Enregistrer le parrainage
        Parrainage::create([
            'electeur_id' => $parrain->id,
            'candidat_id' => $request->input('candidat_id'),
        ]);

        return redirect()->back()->with('success', 'Parrainage enregistré avec succès.');
    }
}
