<?php

namespace App\Http\Controllers;

use App\Models\Preinscription;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ValidationEtudiant;

class PreinscriptionController extends Controller
{
    /**
     * Affiche le formulaire de préinscription
     */
    public function formulaire()
    {
        return view('preinscription.formulaire');
    }

    /**
     * Traite l'envoi du formulaire de préinscription
     */
    public function envoyer(Request $request)
    {
        // Validation des champs
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:preinscriptions,email',
            'telephone' => 'required|string|max:20',
            'niveau' => 'required|string|max:50',
            'option' => 'required|string|max:100',
        ]);

        // Création de la préinscription
        $preinscription = Preinscription::create($request->only([
            'nom',
            'prenom',
            'email',
            'telephone',
            'niveau',
            'option',
        ]));

        // Envoi d’un mail de confirmation dans un bloc try/catch pour gérer les erreurs d’envoi
        try {
            Mail::to($preinscription->email)->send(new \App\Mail\PreinscriptionReçue($preinscription));
        } catch (\Exception $e) {
            // Log l'erreur mais ne bloque pas la validation
            \Log::error('Erreur envoi mail préinscription : ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Votre demande a bien été envoyée.');
    }

    public function index()
    {
        $preinscriptions = Preinscription::latest()->get();
        return view('preinscription.index', compact('preinscriptions'));
    }

    public function destroy($id)
    {
        $preinscription = Preinscription::findOrFail($id);
        $preinscription->delete();

        return redirect()->route('preinscription.index')->with('success', 'Préinscription supprimée.');
    }


    public function valider(Preinscription $preinscription)
    {

        if ($preinscription->valide) {
        return redirect()->route('preinscription.index')
                         ->with('error', 'Cette préinscription est déjà validée.');
        }
        $preinscription->valide = true;
        $preinscription->save();

        return redirect()->route('etudiants.create1', [
            'nom' => $preinscription->nom,
            'prenom' => $preinscription->prenom,
            'email' => $preinscription->email,
            'telephone' => $preinscription->telephone,
            'niveau' => $preinscription->niveau,
            'option' => $preinscription->option,
        ])->with('success', 'Préinscription validée. Veuillez compléter les données de l’étudiant.');
    }
}
