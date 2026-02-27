<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\GroupeCatechese;
use App\Models\NiveauFormation;
use App\Models\Catechiste;
use Illuminate\Http\Request;

class GroupeCatecheseController extends Controller
{
    public function index(Request $request)
    {
        $query = GroupeCatechese::with(['niveauFormation', 'catechistes']);

        if ($request->filled('niveau_id')) {
            $query->where('niveau_formation_id', $request->niveau_id);
        }
        if ($request->filled('annee')) {
            $query->where('annee_pastorale', $request->annee);
        }
        if ($request->filled('actif')) {
            $query->where('actif', $request->actif);
        }

        $groupes = $query->paginate(15);
        $niveaux = NiveauFormation::actif()->get();

        return view('sacrements.groupes.index', compact('groupes', 'niveaux'));
    }

    public function create()
    {
        $niveaux     = NiveauFormation::actif()->get();
        $catechistes = Catechiste::where('actif', true)->orderBy('nom')->get();
        return view('sacrements.groupes.create', compact('niveaux', 'catechistes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'niveau_formation_id' => 'required|exists:niveaux_formation,id',
            'nom'                 => 'required|string|max:100',
            'annee_pastorale'     => 'required|string|max:10',
            'lieu_reunion'        => 'nullable|string|max:150',
            'jour_reunion'        => 'nullable|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            'heure_reunion'       => 'nullable|date_format:H:i',
            'capacite_max'        => 'nullable|integer|min:1',
            'actif'               => 'nullable|boolean',
            'catechistes'         => 'nullable|array',
            'catechistes.*'       => 'exists:catechistes,id',
            'roles'               => 'nullable|array',
        ]);

        $validated['actif'] = $request->has('actif');

        $groupe = GroupeCatechese::create($validated);

        if ($request->filled('catechistes')) {
            $syncData = [];
            foreach ($request->catechistes as $catechisteId) {
                $role = $request->roles[$catechisteId] ?? 'assistant';
                $syncData[$catechisteId] = ['role' => $role];
            }
            $groupe->catechistes()->sync($syncData);
        }

        return redirect()->route('sacrements.groupes.show', $groupe)
            ->with('success', 'Le groupe de catéchèse a été créé avec succès.');
    }

    public function show(GroupeCatechese $groupe)
    {
        $groupe->load(['niveauFormation', 'catechistes', 'catechumenes' => fn($q) => $q->orderBy('nom')]);
        return view('sacrements.groupes.show', compact('groupe'));
    }

    public function edit(GroupeCatechese $groupe)
    {
        $groupe->load('catechistes');
        $niveaux     = NiveauFormation::actif()->get();
        $catechistes = Catechiste::where('actif', true)->orderBy('nom')->get();
        $catechistesActuels = $groupe->catechistes->pluck('id')->toArray();
        return view('sacrements.groupes.edit', compact('groupe', 'niveaux', 'catechistes', 'catechistesActuels'));
    }

    public function update(Request $request, GroupeCatechese $groupe)
    {
        $validated = $request->validate([
            'niveau_formation_id' => 'required|exists:niveaux_formation,id',
            'nom'                 => 'required|string|max:100',
            'annee_pastorale'     => 'required|string|max:10',
            'lieu_reunion'        => 'nullable|string|max:150',
            'jour_reunion'        => 'nullable|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            'heure_reunion'       => 'nullable|date_format:H:i',
            'capacite_max'        => 'nullable|integer|min:1',
            'actif'               => 'nullable|boolean',
            'catechistes'         => 'nullable|array',
            'catechistes.*'       => 'exists:catechistes,id',
        ]);

        $validated['actif'] = $request->has('actif');

        $groupe->update($validated);

        $syncData = [];
        if ($request->filled('catechistes')) {
            foreach ($request->catechistes as $catechisteId) {
                $role = $request->roles[$catechisteId] ?? 'assistant';
                $syncData[$catechisteId] = ['role' => $role];
            }
        }
        $groupe->catechistes()->sync($syncData);

        return redirect()->route('sacrements.groupes.show', $groupe)
            ->with('success', 'Le groupe a été mis à jour avec succès.');
    }

    public function destroy(GroupeCatechese $groupe)
    {
        $hasCatechumenes = $groupe->catechumenes()->whereIn('statut', ['inscrit', 'en_cours'])->exists();

        if ($hasCatechumenes) {
            return redirect()->route('sacrements.groupes.index')
                ->with('error', 'Impossible de supprimer ce groupe : des catéchumènes actifs y sont associés.');
        }

        $groupe->delete();

        return redirect()->route('sacrements.groupes.index')
            ->with('success', 'Le groupe a été supprimé avec succès.');
    }
}
