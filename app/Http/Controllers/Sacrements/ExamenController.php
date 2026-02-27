<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\Examen;
use App\Models\NiveauFormation;
use App\Models\Catechumene;
use App\Models\ResultatExamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{
    public function index(Request $request)
    {
        $query = Examen::with('niveauFormation');

        if ($request->filled('niveau_id')) {
            $query->where('niveau_formation_id', $request->niveau_id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('date_debut')) {
            $query->where('date_examen', '>=', $request->date_debut);
        }

        $examens = $query->orderBy('date_examen', 'desc')->paginate(15);
        $niveaux = NiveauFormation::actif()->get();

        return view('sacrements.examens.index', compact('examens', 'niveaux'));
    }

    public function create()
    {
        $niveaux = NiveauFormation::actif()->get();
        return view('sacrements.examens.create', compact('niveaux'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'niveau_formation_id' => 'required|exists:niveaux_formation,id',
            'titre'               => 'required|string|max:150',
            'description'         => 'nullable|string',
            'type'                => 'required|in:ecrit,oral,pratique,mixte',
            'note_maximale'       => 'required|numeric|min:1',
            'note_passage'        => 'required|numeric|min:0',
            'date_examen'         => 'nullable|date',
            'actif'               => 'nullable|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        Examen::create($validated);

        return redirect()->route('sacrements.examens.index')
            ->with('success', 'L\'examen a été créé avec succès.');
    }

    public function show(Examen $examen)
    {
        $examen->load(['niveauFormation', 'resultats.catechumene']);
        return view('sacrements.examens.show', compact('examen'));
    }

    public function edit(Examen $examen)
    {
        $niveaux = NiveauFormation::actif()->get();
        return view('sacrements.examens.edit', compact('examen', 'niveaux'));
    }

    public function update(Request $request, Examen $examen)
    {
        $validated = $request->validate([
            'niveau_formation_id' => 'required|exists:niveaux_formation,id',
            'titre'               => 'required|string|max:150',
            'description'         => 'nullable|string',
            'type'                => 'required|in:ecrit,oral,pratique,mixte',
            'note_maximale'       => 'required|numeric|min:1',
            'note_passage'        => 'required|numeric|min:0',
            'date_examen'         => 'nullable|date',
            'actif'               => 'nullable|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        $examen->update($validated);

        return redirect()->route('sacrements.examens.index')
            ->with('success', 'L\'examen a été mis à jour avec succès.');
    }

    public function destroy(Examen $examen)
    {
        // Check if the exam has associated results
        $resultatsCount = $examen->resultats()->count() ?? 0;
        
        if ($resultatsCount > 0) {
            return redirect()->route('sacrements.examens.index')
                ->with('error', 'Impossible de supprimer cet examen. Il y a ' . $resultatsCount . ' résultat(s) d\'examen associé(s). Veuillez d\'abord supprimer les résultats.');
        }

        $examen->delete();
        return redirect()->route('sacrements.examens.index')
            ->with('success', 'L\'examen a été supprimé avec succès.');
    }

    public function saisirResultats(Examen $examen)
    {
        $examen->load('niveauFormation');

        // Get catechumenes from the same niveau
        $catechumenes = Catechumene::whereHas('groupeCatechese', function ($q) use ($examen) {
            $q->where('niveau_formation_id', $examen->niveau_formation_id);
        })->orWhereHas('progressions', function ($q) use ($examen) {
            $q->where('niveau_formation_id', $examen->niveau_formation_id)->where('statut', 'en_cours');
        })->orderBy('nom')->get();

        $resultatsExistants = ResultatExamen::where('examen_id', $examen->id)
            ->pluck('note_obtenue', 'catechumene_id');

        return view('sacrements.examens.saisir-resultats', compact('examen', 'catechumenes', 'resultatsExistants'));
    }

    public function enregistrerResultats(Request $request, Examen $examen)
    {
        $request->validate([
            'notes'         => 'required|array',
            'notes.*'       => 'nullable|numeric|min:0',
            'date_examen'   => 'required|date',
        ]);

        $dateExamen = $request->date_examen;

        foreach ($request->notes as $catechumeneId => $note) {
            if ($note === null || $note === '') {
                continue;
            }

            $statut = $note >= $examen->note_passage ? 'reussi' : 'echoue';

            ResultatExamen::updateOrCreate(
                ['catechumene_id' => $catechumeneId, 'examen_id' => $examen->id],
                [
                    'note_obtenue'   => $note,
                    'date_examen'    => $dateExamen,
                    'statut'         => $statut,
                    'observations'   => $request->observations[$catechumeneId] ?? null,
                    'enregistre_par' => Auth::id(),
                ]
            );
        }

        return redirect()->route('sacrements.examens.show', $examen)
            ->with('success', 'Les résultats ont été enregistrés avec succès.');
    }
}
