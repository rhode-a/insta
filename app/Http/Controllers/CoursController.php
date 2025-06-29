<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Matiere;
use App\Models\Option;
use App\Models\Formateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
   public function index()
    {
        $user = Auth::user();

        // Autorisation générale
        if (!in_array($user->role, ['admin', 'formateur', 'etudiant'])) {
            abort(403);
        }

        // On récupère tous les cours pour admin ET formateur
        // (Si tu souhaites restreindre les étudiants, adapte ici)
        $coursQuery = Cours::with(['formateur', 'matiere', 'option'])->latest();

        // Plus besoin de filtrer pour formateur : ils voient tout
        // if ($user->role === 'formateur') {
        //     $coursQuery->where('formateur_id', $user->formateur->id);
        // }

        $cours = $coursQuery->paginate(20);

        return view('cours.index', compact('cours'));
    }



    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $matieres = Matiere::all();
        $formateurs = Formateur::all();
        $options = Option::all();

        return view('cours.create', compact('matieres', 'formateurs','options'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matiere_id'    => 'required|exists:matieres,id',
            'formateur_id'  => 'required|exists:formateurs,id',
            'intitule'      => 'required|string|max:255',
            'nombre_heures' => 'required|integer|min:1',
            'date'          => 'required|date',
            'option_id' => 'required|exists:options,id',
        ]);

        Cours::create([
            'matiere_id'     => $request->matiere_id,
            'formateur_id'   => $request->formateur_id,
            'option_id'      => $request->option_id, // <- change de 'option' à 'option_id'
            'intitule'       => $request->intitule,
            'nombre_heures'  => $request->nombre_heures,
            'date'           => $request->date,
        ]);

        return redirect()->route('cours.index')->with('success', 'Cours enregistré.');
    }

    public function edit(Cours $cour)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $matieres = Matiere::all();
        $formateurs = Formateur::all();
        $options = Option::all();

        return view('cours.edit', compact('cour', 'matieres', 'formateurs', 'options'));
    }

    public function update(Request $request, Cours $cour)
    {
        // Autorisation : seul l’admin peut modifier un cours
        if (Auth::user()->role !== 'admin') {
            abort(403, "Vous n'avez pas les droits pour modifier ce cours.");
        }

        // Validation des champs
        $request->validate([
            'matiere_id'     => 'required|exists:matieres,id',
            'formateur_id'   => 'required|exists:formateurs,id',
            'option_id'      => 'required|exists:options,id',
            'intitule'       => 'required|string|max:255',
            'nombre_heures'  => 'required|integer|min:1',
            'date'           => 'required|date',
        ]);

        // Mise à jour du cours
        $cour->update([
            'matiere_id'     => $request->matiere_id,
            'formateur_id'   => $request->formateur_id,
            'option_id'      => $request->option_id,
            'intitule'       => $request->intitule,
            'nombre_heures'  => $request->nombre_heures,
            'date'           => $request->date,
        ]);

        return redirect()->route('cours.index')->with('success', 'Le cours a été mis à jour avec succès.');
    }


    public function destroy(Cours $cours)
    {
       if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $cours->delete();

        return redirect()->route('cours.index')->with('success', 'Cours supprimé avec succès.');
    }


    public function show(Cours $cours)
    {
        return view('cours.show', compact('cours'));
    }

}
