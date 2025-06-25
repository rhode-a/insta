<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            if(auth()->user()->role !== 'admin' ){
                abort(403, 'Accès refusé');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $options = Option::paginate(15);
        return view('options.index', compact('options'));
    }

    public function create()
    {
        return view('options.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:options,nom',
        ]);

        Option::create($request->only('nom'));

        return redirect()->route('options.index')->with('success', 'Option créée');
    }

    public function edit(Option $option)
    {
        return view('options.edit', compact('option'));
    }

    public function update(Request $request, Option $option)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:options,nom,' . $option->id,
        ]);

        $option->update($request->only('nom'));

        return redirect()->route('options.index')->with('success', 'Option mise à jour');
    }

    public function destroy(Option $option)
    {
        $option->delete();
        return redirect()->route('options.index')->with('success', 'Option supprimée');
    }
}
