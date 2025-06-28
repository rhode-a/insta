<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurController extends Controller
{

    public function index()
    {
        $formateurs = Formateur::with('options')->paginate(15);
        return view('formateurs.index', compact('formateurs'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $options = Option::all();
        return view('formateurs.create', compact('options'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:formateurs,email',
            'telephone' => 'nullable|string|max:20',
            'options' => 'array|exists:options,id',
        ]);

        // Génération du code formateur unique
        $last = Formateur::latest('id')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $code = 'FORM-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $formateur = Formateur::create([
            'user_id' => auth()->id(), // <-- Ajouter cette ligne
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
            'matricule' => $code,
        ]);

        // Lier les options sélectionnées
        $formateur->options()->sync($validated['options'] ?? []);

        return redirect()->route('formateurs.index')->with('success', 'Formateur ajouté avec succès.');
    }

    public function edit(Formateur $formateur)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $options = Option::all();
        return view('formateurs.edit', compact('formateur', 'options'));
    }

    public function update(Request $request, Formateur $formateur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:formateurs,email,' . $formateur->id,
            'telephone' => 'nullable|string|max:20',
            'options' => 'array|exists:options,id',
        ]);

        $formateur->update($validated);
        $formateur->options()->sync($validated['options'] ?? []);

        return redirect()->route('formateurs.index')->with('success', 'Formateur mis à jour avec succès.');
    }

    public function destroy(Formateur $formateur)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, "Seul l'administrateur peut modifier les cours.");
        }
        $formateur->delete();
        return redirect()->route('formateurs.index')->with('success', 'Formateur supprimé.');
    }
}
