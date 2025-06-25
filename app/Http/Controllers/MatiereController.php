<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Formateur;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class MatiereController extends Controller
{

    public function index()
    {
        $matieres = Matiere::with('formateurs')->paginate(20);
        return view('matieres.index', compact('matieres'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $formateurs = Formateur::all();
        $options = Option::all();
        return view('matieres.create', compact('formateurs','options'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:matieres,nom',
            'coefficient' => 'required|integer|min:1',
            'formateurs' => 'array|exists:formateurs,id',
        ]);

        $matiere = Matiere::create([
            'nom' => $request->nom,
            'coefficient' => $request->coefficient,
        ]);

        $matiere->formateurs()->sync($request->formateurs ?? []);

        return redirect()->route('matieres.index')->with('success', 'Matière ajoutée');
    }

    public function edit(Matiere $matiere)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $formateurs = Formateur::all();
        return view('matieres.edit', compact('matiere', 'formateurs'));
    }

    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:matieres,nom,' . $matiere->id,
            'coefficient' => 'required|integer|min:1',
            'formateurs' => 'array|exists:formateurs,id',
        ]);

        $matiere->update([
            'nom' => $request->nom,
            'coefficient' => $request->coefficient,
        ]);

        $matiere->formateurs()->sync($request->formateurs ?? []);

        return redirect()->route('matieres.index')->with('success', 'Matière mise à jour');
    }

    public function destroy(Matiere $matiere)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $matiere->delete();
        return redirect()->route('matieres.index')->with('success', 'Matière supprimée');
    }
}
