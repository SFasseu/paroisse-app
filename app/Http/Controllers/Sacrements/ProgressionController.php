<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\ProgressionCatechumene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'catechumene_id'      => 'required|exists:catechumenes,id',
            'niveau_formation_id' => 'required|exists:niveaux_formation,id',
            'date_debut'          => 'required|date',
            'statut'              => 'nullable|in:en_cours,termine,abandonne,en_attente',
            'commentaires'        => 'nullable|string',
        ]);

        $validated['statut'] = $validated['statut'] ?? 'en_cours';

        ProgressionCatechumene::updateOrCreate(
            [
                'catechumene_id'      => $validated['catechumene_id'],
                'niveau_formation_id' => $validated['niveau_formation_id'],
            ],
            $validated
        );

        return redirect()->back()
            ->with('success', 'La progression a été enregistrée avec succès.');
    }

    public function update(Request $request, ProgressionCatechumene $progression)
    {
        $validated = $request->validate([
            'statut'       => 'required|in:en_cours,termine,abandonne,en_attente',
            'note_finale'  => 'nullable|numeric|min:0',
            'date_fin'     => 'nullable|date',
            'commentaires' => 'nullable|string',
        ]);

        $progression->update($validated);

        return redirect()->back()
            ->with('success', 'La progression a été mise à jour avec succès.');
    }

    public function valider(ProgressionCatechumene $progression)
    {
        $progression->update([
            'valide'          => true,
            'valide_par'      => Auth::id(),
            'date_validation' => now()->toDateString(),
        ]);

        return redirect()->back()
            ->with('success', 'Le niveau a été validé avec succès.');
    }
}
