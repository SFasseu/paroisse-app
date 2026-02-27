<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\Catechumene;
use App\Models\GroupeCatechese;
use App\Models\NiveauFormation;
use Illuminate\Http\Request;

class CatechumeneController extends Controller
{
    public function index(Request $request)
    {
        $query = Catechumene::with(['groupeCatechese.niveauFormation']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nom', 'like', "%$s%")
                  ->orWhere('prenom', 'like', "%$s%")
                  ->orWhere('numero_dossier', 'like', "%$s%");
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('groupe_id')) {
            $query->where('groupe_catechese_id', $request->groupe_id);
        }

        $catechumenes = $query->orderBy('nom')->paginate(15)->withQueryString();
        $groupes      = GroupeCatechese::where('actif', true)->orderBy('nom')->get();

        return view('sacrements.catechumenes.index', compact('catechumenes', 'groupes'));
    }

    public function create()
    {
        $groupes = GroupeCatechese::where('actif', true)->with('niveauFormation')->orderBy('nom')->get();
        return view('sacrements.catechumenes.create', compact('groupes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'                 => 'required|string|max:100',
            'prenom'              => 'required|string|max:100',
            'date_naissance'      => 'required|date|before:today',
            'lieu_naissance'      => 'nullable|string|max:150',
            'sexe'                => 'required|in:M,F',
            'nationalite'         => 'nullable|string|max:100',
            'adresse'             => 'nullable|string',
            'telephone'           => 'nullable|string|max:20',
            'email'               => 'nullable|email|max:150',
            'religion_actuelle'   => 'nullable|string|max:100',
            'statut_matrimonial'  => 'nullable|in:celibataire,marie,divorce,veuf',
            'profession'          => 'nullable|string|max:150',
            'date_inscription'    => 'required|date',
            'groupe_catechese_id' => 'nullable|exists:groupes_catechese,id',
            'statut'              => 'nullable|in:inscrit,en_cours,suspendu,diplome,abandonne',
            'observations'        => 'nullable|string',
        ]);

        if (empty($validated['statut'])) {
            $validated['statut'] = 'inscrit';
        }
        if (empty($validated['nationalite'])) {
            $validated['nationalite'] = 'Camerounaise';
        }

        $catechumene = Catechumene::create($validated);

        return redirect()->route('sacrements.catechumenes.show', $catechumene)
            ->with('success', 'Le dossier du catéchumène a été créé avec succès.');
    }

    public function show(Catechumene $catechumene)
    {
        $catechumene->load([
            'groupeCatechese.niveauFormation',
            'parentsTuteurs',
            'progressions.niveauFormation',
            'progressions.validePar',
            'resultatsExamens.examen.niveauFormation',
            'sacrements',
        ]);

        $niveaux = NiveauFormation::actif()->get();

        return view('sacrements.catechumenes.show', compact('catechumene', 'niveaux'));
    }

    public function edit(Catechumene $catechumene)
    {
        $groupes = GroupeCatechese::where('actif', true)->with('niveauFormation')->orderBy('nom')->get();
        return view('sacrements.catechumenes.edit', compact('catechumene', 'groupes'));
    }

    public function update(Request $request, Catechumene $catechumene)
    {
        $validated = $request->validate([
            'nom'                 => 'required|string|max:100',
            'prenom'              => 'required|string|max:100',
            'date_naissance'      => 'required|date|before:today',
            'lieu_naissance'      => 'nullable|string|max:150',
            'sexe'                => 'required|in:M,F',
            'nationalite'         => 'nullable|string|max:100',
            'adresse'             => 'nullable|string',
            'telephone'           => 'nullable|string|max:20',
            'email'               => 'nullable|email|max:150',
            'religion_actuelle'   => 'nullable|string|max:100',
            'statut_matrimonial'  => 'nullable|in:celibataire,marie,divorce,veuf',
            'profession'          => 'nullable|string|max:150',
            'date_inscription'    => 'required|date',
            'groupe_catechese_id' => 'nullable|exists:groupes_catechese,id',
            'observations'        => 'nullable|string',
        ]);

        $catechumene->update($validated);

        return redirect()->route('sacrements.catechumenes.show', $catechumene)
            ->with('success', 'Le dossier du catéchumène a été mis à jour avec succès.');
    }

    public function destroy(Catechumene $catechumene)
    {
        // Soft delete by changing status to abandoned
        $catechumene->update(['statut' => 'abandonne']);

        return redirect()->route('sacrements.catechumenes.index')
            ->with('success', 'Le dossier du catéchumène a été archivé (statut : abandonné).');
    }

    public function progression(Catechumene $catechumene)
    {
        $catechumene->load(['progressions.niveauFormation', 'progressions.validePar']);
        $niveaux = NiveauFormation::actif()->get();

        return view('sacrements.catechumenes.progression', compact('catechumene', 'niveaux'));
    }

    public function changerStatut(Request $request, Catechumene $catechumene)
    {
        $request->validate([
            'statut' => 'required|in:inscrit,en_cours,suspendu,diplome,abandonne',
        ]);

        $catechumene->update(['statut' => $request->statut]);

        return redirect()->back()
            ->with('success', 'Le statut du catéchumène a été mis à jour avec succès.');
    }
}
