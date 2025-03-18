<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElecteurController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\ParrainController;
use App\Http\Controllers\ParrainageController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\SuiviCandidatController;


// Route pour la page d'accueil
Route::get('/', function () {
    return view('accueil');
    //return view('candidats/login');
    //return view('electeur/accueil');
});

Route::get('/electeurs/import', [ElecteurController::class, 'import'])->name('electeurs.import');
Route::post('/electeurs/import', [ElecteurController::class, 'storeImport'])->name('electeurs.storeImport');

Route::get('/candidats/enregistrer', [CandidatController::class, 'create'])->name('candidats.create');
Route::post('/candidats/enregistrer', [CandidatController::class, 'store'])->name('candidats.store');
Route::post('/candidats', [CandidatController::class, 'store'])->name('candidats.store');


Route::get('/parrains/creer-compte', [ParrainController::class, 'create'])->name('parrains.create');
Route::post('/parrains/creer-compte', [ParrainController::class, 'store'])->name('parrains.store');

Route::get('/parrainages/enregistrer', [ParrainageController::class, 'create'])->name('parrainages.create');
Route::post('/parrainages/enregistrer', [ParrainageController::class, 'store'])->name('parrainages.store');

Route::get('/periodes/definir', [PeriodeController::class, 'create'])->name('periodes.create');
Route::post('/periodes/definir', [PeriodeController::class, 'store'])->name('periodes.store');

Route::get('/parrainages/statistiques', [ParrainageController::class, 'statistiques'])->name('parrainages.statistiques');

Route::get('/candidats/evolution', [CandidatController::class, 'evolution'])->name('candidats.evolution');




// === Routes pour les électeurs ===

Route::get('/electeur/parrainage', [ElecteurController::class, 'showParrainageForm'])->name('electeur.parrainage');
//Route::post('/electeur/parrainage', [ElecteurController::class, 'processParrainage']);
Route::post('/electeur/parrainage', [ElecteurController::class, 'processParrainage'])->name('electeur.parrainage');


// Route pour afficher le formulaire d'inscription (GET)
Route::get('/electeur/inscription', [ElecteurController::class, 'showInscriptionForm'])->name('electeur.inscription');

// Route pour traiter l'inscription (POST)
Route::post('/electeur/inscription', [ElecteurController::class, 'processInscription']);

// Route pour afficher le formulaire de connexion (GET)
Route::get('/electeur/connexion', [ElecteurController::class, 'showConnexionForm'])->name('electeur.connexion');

// Route pour traiter la connexion (POST)
Route::post('/electeur/connexion', [ElecteurController::class, 'processConnexion']);

// Route pour la page d'accueil des électeurs
Route::get('/electeur/accueil', [ElecteurController::class, 'showAccueil'])->name('electeur.accueil');

// Route pour afficher la page d'authentification
Route::get('/electeur/authentification', [ElecteurController::class, 'showAuthentificationForm'])->name('electeur.authentification');

// Route pour vérifier le code d'authentification
Route::post('/electeur/verifier_code', [ElecteurController::class, 'verifierCode'])->name('electeur.verifier_code');


// Routes pour le candidat (suivi des parrainages)
Route::get('/candidats', [CandidatController::class, 'index'])->name('candidats.index');
Route::get('/candidats/login', [SuiviCandidatController::class, 'loginForm'])->name('candidats.login');
Route::post('/candidats/login', [SuiviCandidatController::class, 'login']);
Route::get('/candidats/dashboard', [SuiviCandidatController::class, 'dashboard'])->name('candidats.dashboard');
Route::get('/candidats/logout', [SuiviCandidatController::class, 'logout'])->name('candidats.logout');
