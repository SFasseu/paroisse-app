<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\Catechumene;
use App\Models\Sacrement;
use Illuminate\Http\Request;

class SacrementRecuController extends Controller
{
    public function index(Catechumene $catechumene)
    {
        $catechumene->load('sacrements');
        return view('sacrements.sacrements.index', compact('catechumene'));
    }

    public function create(Catechumene $catechumene)
    {
        return view('sacrements.sacrements.create', compact('catechumene'));
    }

    public function store(Request $request, Catechumene $catechumene)
    {
        $validated = $request->validate([
            'type_sacrement'   => 'required|in:bapteme,premiere_communion,confirmation,mariage,ordre',
            'date_sacrement'   => 'required|date',
            'lieu_sacrement'   => 'nullable|string|max:200',
            'pretre_officiant' => 'nullable|string|max:150',
            'parrain'          => 'nullable|string|max:150',
            'marraine'         => 'nullable|string|max:150',
            'numero_registre'  => 'nullable|string|max:100',
            'observations'     => 'nullable|string',
        ]);

        $validated['catechumene_id'] = $catechumene->id;

        Sacrement::create($validated);

        return redirect()->route('sacrements.catechumenes.show', $catechumene)
            ->with('success', 'Le sacrement a été enregistré avec succès.');
    }

    public function edit(Sacrement $sacrement)
    {
        $sacrement->load('catechumene');
        return view('sacrements.sacrements.edit', compact('sacrement'));
    }

    public function update(Request $request, Sacrement $sacrement)
    {
        $validated = $request->validate([
            'type_sacrement'   => 'required|in:bapteme,premiere_communion,confirmation,mariage,ordre',
            'date_sacrement'   => 'required|date',
            'lieu_sacrement'   => 'nullable|string|max:200',
            'pretre_officiant' => 'nullable|string|max:150',
            'parrain'          => 'nullable|string|max:150',
            'marraine'         => 'nullable|string|max:150',
            'numero_registre'  => 'nullable|string|max:100',
            'observations'     => 'nullable|string',
        ]);

        $sacrement->update($validated);

        return redirect()->route('sacrements.catechumenes.show', $sacrement->catechumene)
            ->with('success', 'Le sacrement a été mis à jour avec succès.');
    }

    public function destroy(Sacrement $sacrement)
    {
        $catechumene = $sacrement->catechumene;
        $sacrement->delete();

        return redirect()->route('sacrements.catechumenes.show', $catechumene)
            ->with('success', 'Le sacrement a été supprimé avec succès.');
    }
}
