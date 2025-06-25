<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin', 'formateur', 'etudiant'])) {
            abort(403);
        }
        return view('articles.create');
    }

    public function edit(Article $article)
    {
        if (auth()->user()->role !== 'admin' && auth()->id() !== $article->user_id) {
            abort(403, 'Accès interdit');
        }

        return view('articles.edit', compact('article'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        Article::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article publié.');
    }

    public function destroy(Article $article)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article supprimé.');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

}
