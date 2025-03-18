<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Electeur;
use App\Models\Candidat;
use App\Models\Parrainage;
use App\Models\Parrain;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendAuthCode;

class ElecteurController extends Controller
{
    // === Méthodes pour la DGE ===

    // Afficher le formulaire d'importation (GET)
    public function import()
    {
        return view('import-electeurs');
    }

    // Traiter l'importation du fichier CSV (POST)
    public function storeImport(Request $request)
    {
        $request->validate([
            'fichier_csv' => 'required|mimes:csv,txt',
            'checksum' => 'required|string',
        ]);

        $file = $request->file('fichier_csv');
        $filePath = $file->getRealPath();
        $checksum = hash_file('sha256', $filePath);

        // Vérifier le checksum
        if ($checksum !== $request->input('checksum')) {
            return redirect()->back()->with('error', 'Le checksum ne correspond pas.');
        }

        // Lire le fichier CSV
        $data = array_map('str_getcsv', file($filePath));

        // Ignorer la première ligne (en-têtes)
        $headers = array_shift($data);

        // Valider chaque ligne
        foreach ($data as $row) {
            if (count($row) !== 7) {
                return redirect()->back()->with('error', 'Format de fichier invalide.');
            }

            // Enregistrer dans la table temporaire
            DB::table('electeurs_temporaires')->insert([
                'numero_carte_identite' => $row[0],
                'numero_electeur' => $row[1],
                'nom' => $row[2],
                'prenom' => $row[3],
                'date_naissance' => $row[4],
                'lieu_naissance' => $row[5],
                'sexe' => $row[6],
            ]);
        }

        return redirect()->back()->with('success', 'Fichier importé avec succès.');
    }

    // === Méthodes pour les électeurs ===

    // Afficher le formulaire d'inscription (GET)
    public function showInscriptionForm()
    {
        return view('electeur.inscription');
    }

    // Traiter l'inscription de l'électeur (POST)
    public function processInscription(Request $request)
    {
        $request->validate([
            'numero_carte_identite' => 'required|unique:electeurs,numero_carte_identite',
            'numero_electeur' => 'required|unique:electeurs,numero_electeur',
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required',
            'sexe' => 'required|in:M,F',
            'bureau_vote' => 'required',
            'telephone' => 'required|unique:electeurs',
            'email' => 'required|email|unique:electeurs',
        ]);

        // Générer un code d'authentification
        $code_authentification = rand(10000, 99999);

        // Enregistrer l'électeur dans la table `electeurs`
        $electeur = Electeur::create([
            'numero_carte_identite' => $request->numero_carte_identite,
            'numero_electeur' => $request->numero_electeur,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'sexe' => $request->sexe,
            'bureau_vote' => $request->bureau_vote,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'code_authentification' => Hash::make($code_authentification),
        ]);

       /* // Envoyer le code d'authentification par email
        Mail::to($electeur->email)->send(new SendAuthCode($code_authentification));

        // Envoyer le code d'authentification par SMS (à implémenter)
        // $this->sendSms($electeur->telephone, "Votre code d'authentification est : $code_authentification"); */

        // Rediriger vers la page de connexion avec un message de succès
        return redirect()->route('electeur.connexion')->with('success', 'Inscription réussie ! Un code d\'authentification vous a été envoyé.');
    }

    // Afficher le formulaire de parrainage (GET)
    public function showParrainageForm()
    {
        $candidats = Candidat::all();
        return view('electeur.parrainage', compact('candidats'));
    }

    // Traiter le parrainage (POST)
    public function processParrainage(Request $request)
    {
        $request->validate([
            'numero_carte_identite' => 'required',
            'numero_electeur' => 'required',
            'candidat_id' => 'required|exists:candidats,id',
            'code_authentification' => 'required',
        ]);

        // Vérifier l'électeur
        $electeur = Electeur::where('numero_carte_identite', $request->numero_carte_identite)
            ->where('numero_electeur', $request->numero_electeur)
            ->first();

        if ($electeur && Hash::check($request->code_authentification, $electeur->code_authentification)) {
            // Enregistrer le parrainage
            Parrainage::create([
                'electeur_id' => $electeur->id,
                'candidat_id' => $request->candidat_id,
                'code_authentification' => $request->code_authentification,
            ]);

            return redirect()->route('electeur.parrainage')->with('success', 'Parrainage enregistré avec succès !');
        }

        return back()->withErrors(['error' => 'Électeur non trouvé ou code invalide.']);
    }

    // Afficher la page d'accueil des électeurs
    public function showAccueil()
    {
        return view('electeur.accueil');
    }

    // Afficher le formulaire de connexion (GET)
    public function showConnexionForm()
    {
        return view('electeur.connexion');
    }

    // Traiter la connexion (POST)
    public function processConnexion(Request $request)
    {
        $request->validate([
            'numero_carte_identite' => 'required',
            'numero_electeur' => 'required',
        ]);

        // Vérifier l'électeur
        $electeur = Electeur::where('numero_carte_identite', $request->numero_carte_identite)
            ->where('numero_electeur', $request->numero_electeur)
            ->first();

        if ($electeur) {
            // Rediriger vers la page d'authentification
            return redirect()->route('electeur.authentification')->with('electeur_id', $electeur->id);
        }

        return back()->withErrors(['error' => 'Informations de connexion invalides.']);
    }

    // Vérifier le code d'authentification (POST)
    public function verifierCode(Request $request)
    {
        $request->validate([
            'electeur_id' => 'required',
            'code_authentification' => 'required',
        ]);

        // Récupérer l'électeur
        $electeur = Electeur::find($request->electeur_id);

        if ($electeur && Hash::check($request->code_authentification, $electeur->code_authentification)) {
            // Rediriger vers la page de parrainage
            return redirect()->route('electeur.parrainage')->with('candidats', Candidat::all());
        }

        return back()->withErrors(['error' => 'Code d\'authentification invalide.']);
    }

    // Afficher le formulaire d'authentification (GET)
    public function showAuthentificationForm()
    {
        return view('electeur.authentification');
    }
}
