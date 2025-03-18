<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use Carbon\Carbon;

class PeriodeController extends Controller
{
    public function create()
    {
        return view('periodes-parrainage');
    }
    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        // Vérifier que la date de début est à au moins 6 mois
        if (Carbon::parse($request->input('date_debut'))->diffInMonths(now()) < 6) {
            return redirect()->back()->with('error', 'La date de début doit être à au moins 6 mois.');
        }

        // Enregistrer les dates
        Periode::create($request->all());

        return redirect()->back()->with('success', 'Période de parrainage enregistrée avec succès.');
    }
}
