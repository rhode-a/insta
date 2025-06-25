<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Option;
use App\Models\Niveau;
use App\Models\Preinscription;
use Illuminate\Http\Request;
use App\Mail\ValidationEtudiant;
use Illuminate\Support\Facades\Mail;

class EtudiantController extends Controller
{
    // Middleware pour limiter accès aux admins
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            if(auth()->user()->role !== 'admin'){
                abort(403, 'Accès refusé');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $etudiants = Etudiant::with(['option', 'niveau'])->paginate(15);
        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $options = Option::all();
        $niveaux = Niveau::all();
        return view('etudiants.create', compact('options', 'niveaux'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'telephone' => 'nullable|string|max:20',
            'option_id' => 'required|exists:options,id',
            'niveau_id' => 'required|exists:niveaux,id',
        ]);

        $last = Etudiant::latest('id')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $validated['matricule'] = 'TTG-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        Etudiant::create($validated);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant créé avec succès');
    }

    public function edit(Etudiant $etudiant)
    {
        $options = Option::all();
        $niveaux = Niveau::all();
        return view('etudiants.edit', compact('etudiant', 'options', 'niveaux'));
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'telephone' => 'nullable|string|max:20',
            'option_id' => 'required|exists:options,id',
            'niveau_id' => 'required|exists:niveaux,id',
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès');
    }

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé');
    }


    public function create1(Preinscription $preinscription)
    {
        $data = [
            'nom'       => $preinscription->nom,
            'prenom'    => $preinscription->prenom,
            'email'     => $preinscription->email,
            'telephone' => $preinscription->telephone,
            'niveau'    => $preinscription->niveau,
            'option'    => $preinscription->option,
        ];
        $options = Option::all();
        $niveaux = Niveau::all();
        
        try {
            Mail::to($etudiant->email)->send(new ValidationEtudiant($etudiant));
        } catch (\Exception $e) {
            \Log::error('Erreur envoi mail étudiant validé : ' . $e->getMessage());
        }
        return view('etudiants.create1', compact('data','options','niveaux'));
    }


    
}
