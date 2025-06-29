<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('profile.index', [
            'user' => auth()->user(),
        ]);
    }

    public function show(User $user): View
    {
        // Pour sécurité : seuls admin ou utilisateur lui-même peuvent voir

        return view('profile.show', compact('user'));
    }

    public function edit(User $user): View
    {
        if (auth()->id() !== $user->id && auth()->user()->role !== 'admin') {
            abort(403,"seul l'admin peut modifier");
        }

        return view('profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        if (auth()->id() !== $user->id && auth()->user()->role !== 'admin') {
            abort(403,"seul l'admin peut modifier");
        }

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit', $user->id)->with('status', 'profile-updated');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if (auth()->id() !== $user->id && auth()->user()->role !== 'admin') {
            abort(403,"seul l'admin peut modifier");
        }

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
