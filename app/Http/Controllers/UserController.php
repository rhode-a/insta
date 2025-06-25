<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        // Protéger toutes les routes si non connecté
        $this->middleware('auth');
    }

    public function index()
    {
        // Seuls les admins peuvent accéder à la liste complète
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Accès refusé');
        }

        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Seul un administrateur peut créer un utilisateur.');
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,etudiant,formateur,parent',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit(User $user)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Seul un administrateur peut modifier un utilisateur.');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Seul un administrateur peut modifier un utilisateur.');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,etudiant,formateur,parent',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Seul un administrateur peut supprimer un utilisateur.');
        }

        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }
}
