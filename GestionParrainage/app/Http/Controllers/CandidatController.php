<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Parrainage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class CandidatController extends Controller
{
    /**
     * Affiche le formulaire d'enregistrement d'un candidat.
     */
    public function create()
    {
        return view('candidats.create');
    }

    /**
     * Enregistre un candidat.
     */
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'numero_electeur' => 'required|unique:candidats',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'email' => 'required|email|unique:candidats',
            'telephone' => 'required|unique:candidats',
            'parti_politique' => 'nullable|string',
            'slogan' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'couleurs_parti' => 'nullable|string',
            'url_page' => 'nullable|url',
        ]);

        // Gestion de l'upload de la photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos_candidats', 'public');
        }

        // Création du candidat
        $candidat = Candidat::create([
            'numero_electeur' => $request->numero_electeur,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'parti_politique' => $request->parti_politique,
            'slogan' => $request->slogan,
            'photo' => $photoPath,
            'couleurs_parti' => $request->couleurs_parti,
            'url_page' => $request->url_page,
        ]);

        // Génération et envoi du code de sécurité (à implémenter avec un service d'email/SMS)
        $code = rand(10000, 99999);
        // Mail::to($candidat->email)->send(new CodeValidationCandidat($code));

        return redirect()->route('candidats.index')->with('success', 'Candidat enregistré avec succès.');
    }

    /**
     * Affiche la liste des candidats.
     */
    public function index()
    {
        $candidats = Candidat::all();
        return view('candidats.index', compact('candidats'));
    }

    /**
     * Affiche les détails d'un candidat et ses parrainages.
     */
    public function show($id)
    {
        $candidat = Candidat::findOrFail($id);
        $parrainages = Parrainage::where('id_candidat', $id)->with('electeur')->get();

        return view('candidats.show', compact('candidat', 'parrainages'));
    }

    /**
     * Suivi de l'évolution des parrainages des candidats sous forme de graphique.
     */
    public function evolution()
    {
        // Récupération des candidats avec le nombre de parrainages
        $candidats = Candidat::withCount('parrainages')->get();

        // Préparer les données pour le graphique
        $labels = $candidats->pluck('nom')->toArray();
        $data = $candidats->pluck('parrainages_count')->toArray();

        return view('candidats.evolution', compact('labels', 'data'));
    }

    public function dashboard()
    {
        // Vérifier que le candidat est authentifié via la session
        if (!session()->has('candidat_id')) {
            return redirect()->route('candidats.login')->with('error', 'Vous devez être connecté.');
        }

        // Récupérer le candidat connecté
        $candidat = Candidat::findOrFail(session('candidat_id'));

        // Récupérer les parrainages associés au candidat
        $parrainages = Parrainage::where('candidat_id', $candidat->id)->with('electeur')->get();

        return view('candidats.dashboard', compact('candidat', 'parrainages'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code_auth' => 'required'
        ]);

        // Vérifier si le candidat existe
        $candidat = Candidat::where('email', $request->email)->first();

        if (!$candidat || $candidat->code_auth != $request->code_auth) {
            return back()->with('error', 'Email ou code d’authentification incorrect.');
        }

        // Stocker l'ID du candidat dans la session
        session(['candidat_id' => $candidat->id]);

        return redirect()->route('candidats.dashboard');
    }

    public function logout()
    {
        session()->forget('candidat_id');
        return redirect()->route('candidats.login');
    }


}
