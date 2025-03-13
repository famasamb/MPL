<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use App\Models\Parrainage;
use Illuminate\Support\Facades\DB;

class BackofficeController extends Controller
{
    /**
     * Ouvrir la période de parrainage
     */
    public function ouvrirParrainage(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        // Vérifier que la date de début est à au moins 6 mois
        if (now()->diffInMonths($request->input('date_debut')) < 6) {
            return response()->json(['error' => 'La date de début doit être à au moins 6 mois.'], 400);
        }

        // Enregistrer les dates dans la base de données
        Periode::create([
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
        ]);

        return response()->json(['message' => 'Période de parrainage ouverte avec succès.'], 200);
    }

    /**
     * Fermer la période de parrainage
     */
    public function fermerParrainage(Request $request)
    {
        // Fermer la période de parrainage (par exemple, en mettant à jour une colonne "est_ouverte")
        Periode::where('est_ouverte', true)->update(['est_ouverte' => false]);

        return response()->json(['message' => 'Période de parrainage fermée avec succès.'], 200);
    }

    /**
     * Obtenir les statistiques des parrainages
     */
    public function statistiquesParrainages()
    {
        // Récupérer les statistiques des parrainages par candidat
        $statistiques = DB::table('parrainages')
            ->join('candidats', 'parrainages.candidat_id', '=', 'candidats.id')
            ->select('candidats.nom', 'candidats.prenom', DB::raw('COUNT(parrainages.id) as total_parrainages'))
            ->groupBy('candidats.id')
            ->get();

        return response()->json($statistiques, 200);
    }
}
