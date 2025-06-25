<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\Matiere;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with(['etudiant', 'matiere'])->paginate(20);
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $etudiants = \App\Models\Etudiant::all();
        $matieres = \App\Models\Matiere::all();
        return view('notes.create', compact('etudiants', 'matieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'valeur' => 'required|numeric|min:0|max:20',
            'coefficient' => 'required|integer|min:1',
        ]);

        Note::create($validated);

        return redirect()->route('notes.index')->with('success', 'Note ajoutée');
    }

    public function edit(Note $note)
    {
        $etudiants = \App\Models\Etudiant::all();
        $matieres = \App\Models\Matiere::all();
        return view('notes.edit', compact('note', 'etudiants', 'matieres'));
    }

    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'valeur' => 'required|numeric|min:0|max:20',
            'coefficient' => 'required|integer|min:1',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')->with('success', 'Note mise à jour');
    }
};