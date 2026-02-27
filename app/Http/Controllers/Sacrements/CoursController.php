<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\Cours;
use App\Models\NiveauFormation;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    public function index(Request $request)
    {
        $query = Cours::with('niveauFormation')->orderBy('ordre');

        if ($request->filled('niveau_id')) {
            $query->where('niveau_formation_id', $request->niveau_id);
        }

        $cours = $query->paginate(15);
        $niveaux = NiveauFormation::actif()->get();

        return view('sacrements.cours.index', compact('cours', 'niveaux'));
    }

    public function create()
    {
        $niveaux = NiveauFormation::actif()->get();
        return view('sacrements.cours.create', compact('niveaux'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'niveau_formation_id' => 'required|exists:niveaux_formation,id',
            'titre'               => 'required|string|max:150',
            'description'         => 'nullable|string',
            'objectifs'           => 'nullable|string',
            'duree_heures'        => 'nullable|numeric|min:0',
            'ordre'               => 'required|integer|min:1',
            'materiel_requis'     => 'nullable|string',
            'actif'               => 'nullable|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        Cours::create($validated);

        return redirect()->route('sacrements.cours.index', ['niveau_id' => $validated['niveau_formation_id']])
            ->with('success', 'Le cours a été créé avec succès.');
    }

    public function show(Cours $cours)
    {
        $cours->load('niveauFormation');
        return view('sacrements.cours.show', compact('cours'));
    }

    public function edit(Cours $cours)
    {
        $niveaux = NiveauFormation::actif()->get();
        return view('sacrements.cours.edit', compact('cours', 'niveaux'));
    }

    public function update(Request $request, Cours $cours)
    {
        $validated = $request->validate([
            'niveau_formation_id' => 'required|exists:niveaux_formation,id',
            'titre'               => 'required|string|max:150',
            'description'         => 'nullable|string',
            'objectifs'           => 'nullable|string',
            'duree_heures'        => 'nullable|numeric|min:0',
            'ordre'               => 'required|integer|min:1',
            'materiel_requis'     => 'nullable|string',
            'actif'               => 'nullable|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        $cours->update($validated);

        return redirect()->route('sacrements.cours.index')
            ->with('success', 'Le cours a été mis à jour avec succès.');
    }

    public function destroy(Cours $cours)
    {
        $cours->delete();

        return redirect()->route('sacrements.cours.index')
            ->with('success', 'Le cours a été supprimé avec succès.');
    }
}
