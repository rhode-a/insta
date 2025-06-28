<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NiveauController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
         if (!in_array(Auth::user()->role, ['admin', 'formateur', 'etudiant'])) {
            abort(403);
        }
        $niveaux = Niveau::paginate(15);
        return view('niveaux.index', compact('niveaux'));
    }

    public function create()
    {
        return view('niveaux.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:niveaux,nom',
        ]);

        Niveau::create($request->only('nom'));

        return redirect()->route('niveaux.index')->with('success', 'Niveau ajouté');
    }

    public function edit(Niveau $niveau)
    {
        return view('niveaux.edit', compact('niveau'));
    }

    public function update(Request $request, Niveau $niveau)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:niveaux,nom,' . $niveau->id,
        ]);

        $niveau->update($request->only('nom'));

        return redirect()->route('niveaux.index')->with('success', 'Niveau mis à jour');
    }

    public function destroy(Niveau $niveau)
    {
        $niveau->delete();
        return redirect()->route('niveaux.index')->with('success', 'Niveau supprimé');
    }
    public function show($id)
    {
        $niveau = \App\Models\Niveau::findOrFail($id);
        return view('niveaux.show', compact('niveau'));
    }

}
