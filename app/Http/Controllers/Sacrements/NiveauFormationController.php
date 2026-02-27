<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\NiveauFormation;
use Illuminate\Http\Request;

class NiveauFormationController extends Controller
{
    public function index()
    {
        $niveaux = NiveauFormation::orderBy('ordre')->paginate(15);
        return view('sacrements.niveaux.index', compact('niveaux'));
    }

    public function create()
    {
        return view('sacrements.niveaux.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'          => 'required|string|max:100',
            'ordre'        => 'required|integer|min:1',
            'duree_mois'   => 'required|integer|min:1',
            'description'  => 'nullable|string',
            'age_minimum'  => 'nullable|integer|min:0|max:100',
            'actif'        => 'nullable|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        NiveauFormation::create($validated);

        return redirect()->route('sacrements.niveaux.index')
            ->with('success', 'Le niveau de formation a été créé avec succès.');
    }

    public function show(NiveauFormation $niveau)
    {
        $niveau->load(['cours' => fn($q) => $q->orderBy('ordre'), 'examens', 'groupesCatechese']);
        return view('sacrements.niveaux.show', compact('niveau'));
    }

    public function edit(NiveauFormation $niveau)
    {
        return view('sacrements.niveaux.edit', compact('niveau'));
    }

    public function update(Request $request, NiveauFormation $niveau)
    {
        $validated = $request->validate([
            'nom'          => 'required|string|max:100',
            'ordre'        => 'required|integer|min:1',
            'duree_mois'   => 'required|integer|min:1',
            'description'  => 'nullable|string',
            'age_minimum'  => 'nullable|integer|min:0|max:100',
            'actif'        => 'nullable|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        $niveau->update($validated);

        return redirect()->route('sacrements.niveaux.index')
            ->with('success', 'Le niveau de formation a été mis à jour avec succès.');
    }

    public function destroy(NiveauFormation $niveau)
    {
        // Check if any catechumenes are linked
        $hasCatechumenes = $niveau->progressions()->exists();

        if ($hasCatechumenes) {
            $niveau->update(['actif' => false]);
            return redirect()->route('sacrements.niveaux.index')
                ->with('success', 'Le niveau a été désactivé (des catéchumènes y sont associés).');
        }

        $niveau->delete();

        return redirect()->route('sacrements.niveaux.index')
            ->with('success', 'Le niveau de formation a été supprimé avec succès.');
    }
}
