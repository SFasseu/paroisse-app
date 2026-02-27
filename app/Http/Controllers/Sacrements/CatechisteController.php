<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\Catechiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatechisteController extends Controller
{
    public function index()
    {
        $catechistes = Catechiste::withCount('groupes')->orderBy('nom')->paginate(15);
        return view('sacrements.catechistes.index', compact('catechistes'));
    }

    public function create()
    {
        return view('sacrements.catechistes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'             => 'required|string|max:100',
            'prenom'          => 'required|string|max:100',
            'telephone'       => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:150',
            'date_naissance'  => 'nullable|date|before:today',
            'date_engagement' => 'nullable|date',
            'specialite'      => 'nullable|string|max:150',
            'photo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'actif'           => 'nullable|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('catechistes', 'public');
            $validated['photo'] = $path;
        }

        Catechiste::create($validated);

        return redirect()->route('sacrements.catechistes.index')
            ->with('success', 'Le catéchiste a été enregistré avec succès.');
    }

    public function show(Catechiste $catechiste)
    {
        $catechiste->load('groupes.niveauFormation');
        return view('sacrements.catechistes.show', compact('catechiste'));
    }

    public function edit(Catechiste $catechiste)
    {
        return view('sacrements.catechistes.edit', compact('catechiste'));
    }

    public function update(Request $request, Catechiste $catechiste)
    {
        $validated = $request->validate([
            'nom'             => 'required|string|max:100',
            'prenom'          => 'required|string|max:100',
            'telephone'       => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:150',
            'date_naissance'  => 'nullable|date|before:today',
            'date_engagement' => 'nullable|date',
            'specialite'      => 'nullable|string|max:150',
            'photo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'actif'           => 'nullable|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($catechiste->photo) {
                Storage::disk('public')->delete($catechiste->photo);
            }
            $path = $request->file('photo')->store('catechistes', 'public');
            $validated['photo'] = $path;
        }

        $catechiste->update($validated);

        return redirect()->route('sacrements.catechistes.show', $catechiste)
            ->with('success', 'Le catéchiste a été mis à jour avec succès.');
    }

    public function destroy(Catechiste $catechiste)
    {
        // Check if catechiste is assigned to any groups
        $groupesCount = $catechiste->groupes()->count() ?? 0;
        
        if ($groupesCount > 0) {
            return redirect()->route('sacrements.catechistes.index')
                ->with('error', 'Impossible de supprimer ce catéchiste. Il est assigné à ' . $groupesCount . ' groupe(s). Veuillez d\'abord le retirer des groupes.');
        }

        if ($catechiste->photo) {
            Storage::disk('public')->delete($catechiste->photo);
        }

        $catechiste->delete();

        return redirect()->route('sacrements.catechistes.index')
            ->with('success', 'Le catéchiste a été supprimé avec succès.');
    }
}
