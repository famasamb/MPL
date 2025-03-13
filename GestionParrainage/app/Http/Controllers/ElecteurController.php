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

             // Convertir la date si nécessaire
            $date_naissance = $row[4]; // La date au format d'origine
            $date_naissance = \DateTime::createFromFormat('d/m/Y', $date_naissance); // Convertir en objet DateTime
            if ($date_naissance) {
                $date_naissance = $date_naissance->format('Y-m-d'); // Convertir en format MySQL
            } else {
                return redirect()->back()->with('error', 'Format de date invalide : ' . $row[4]);
            }

            // Enregistrer dans la table temporaire
            DB::table('electeurs_temporaires')->insert([
                'numero_carte_identite' => $row[0],
                'numero_electeur' => $row[1],
                'nom' => $row[2],
                'prenom' => $row[3],
                'date_naissance' => $date_naissance,
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
            'numero_carte_identite' => 'required|unique:parrains,cin',
            'numero_electeur' => 'required|unique:parrains,numero_electeur',
            'nom' => 'required',
            'bureau_vote' => 'required',
            'telephone' => 'required|unique:parrains',
            'email' => 'required|email|unique:parrains',
        ]);

        // Générer un code d'authentification
        $code_authentification = rand(10000, 99999);

        // Enregistrer l'électeur dans la table `parrains`
        $parrain = Parrain::create([
            'cin' => $request->numero_carte_identite,
            'numero_electeur' => $request->numero_electeur,
            'nom' => $request->nom,
            'bureau_vote' => $request->bureau_vote,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'code_authentification' => Hash::make($code_authentification),
        ]);

        // Envoyer le code d'authentification par email
        Mail::to($parrain->email)->send(new SendAuthCode($code_authentification));

        // Envoyer le code d'authentification par SMS (à implémenter)
        // $this->sendSms($parrain->telephone, "Votre code d'authentification est : $code_authentification");

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
        $parrain = Parrain::where('cin', $request->numero_carte_identite)
            ->where('numero_electeur', $request->numero_electeur)
            ->first();

        if ($parrain && Hash::check($request->code_authentification, $parrain->code_authentification)) {
            // Enregistrer le parrainage
            Parrainage::create([
                'electeur_id' => $parrain->id,
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
        $parrain = Parrain::where('cin', $request->numero_carte_identite)
            ->where('numero_electeur', $request->numero_electeur)
            ->first();

        if ($parrain) {
            // Rediriger vers la page d'authentification
            return redirect()->route('electeur.authentification')->with('parrain_id', $parrain->id);
        }

        return back()->withErrors(['error' => 'Informations de connexion invalides.']);
    }

    public function verifierCode(Request $request)
    {
        $request->validate([
            'parrain_id' => 'required',
            'code_authentification' => 'required',
        ]);

        // Récupérer l'électeur
        $parrain = Parrain::find($request->parrain_id);

        if ($parrain && Hash::check($request->code_authentification, $parrain->code_authentification)) {
            // Rediriger vers la page de parrainage
            return redirect()->route('electeur.parrainage');
        }

        return back()->withErrors(['error' => 'Code d\'authentification invalide.']);
    }

    // Afficher le formulaire d'authentification
    public function showAuthentificationForm()
    {
        return view('electeur.authentification');
    }
}
