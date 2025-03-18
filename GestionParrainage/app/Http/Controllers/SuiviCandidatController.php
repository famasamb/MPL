<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use Illuminate\Support\Facades\Session;

class SuiviCandidatController extends Controller
{
    /**
     * Affiche le formulaire de connexion du candidat.
     */
    public function loginForm()
    {
        return view('candidats.login');
    }

    /**
     * Authentifie le candidat.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code_auth' => 'required'
        ]);

        $candidat = Candidat::where('email', $request->email)
                            ->where('code_auth', $request->code_auth)
                            ->first();

        if ($candidat) {
            Session::put('candidat_id', $candidat->id);
            return redirect()->route('candidats.dashboard');
        }

        return back()->with('error', 'Email ou code incorrect.');
    }

    /**
     * Affiche le tableau de bord du candidat.
     */
    public function dashboard()
    {
        if (!Session::has('candidat_id')) {
            return redirect()->route('candidats.login')->with('error', 'Veuillez vous connecter.');
        }

        $candidat = Candidat::find(Session::get('candidat_id'));
        $parrainages = $candidat->parrainages()->with('electeur')->get();

        return view('candidats.dashboard', compact('candidat', 'parrainages'));
    }

    /**
     * Déconnexion du candidat.
     */
    public function logout()
    {
        Session::forget('candidat_id');
        return redirect()->route('candidats.login');
    }
}
