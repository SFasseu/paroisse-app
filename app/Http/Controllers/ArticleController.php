<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::paginate(10);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'quantite' => 'required|integer',
            'prix' => 'required|numeric'
        ]);

        Article::create($request->all());

        return redirect()->route('articles.index')
                         ->with('success', 'Article ajouté avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'nom' => 'required',
            'quantite' => 'required|integer',
            'prix' => 'required|numeric'
        ]);

        $article->update($request->all());

        return redirect()->route('articles.index')
                         ->with('success', 'Article modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
                         ->with('success', 'Article supprimé avec succès');
    }
}
