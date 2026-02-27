<?php

namespace App\Http\Controllers\Sacrements;

use App\Http\Controllers\Controller;
use App\Models\Catechumene;
use App\Models\GroupeCatechese;
use App\Models\NiveauFormation;
use App\Models\Examen;
use App\Models\ResultatExamen;

class SacrementsController extends Controller
{
    public function index()
    {
        $stats = [
            'total_catechumenes'   => Catechumene::count(),
            'inscrit'              => Catechumene::where('statut', 'inscrit')->count(),
            'en_cours'             => Catechumene::where('statut', 'en_cours')->count(),
            'diplome'              => Catechumene::where('statut', 'diplome')->count(),
            'abandonne'            => Catechumene::where('statut', 'abandonne')->count(),
            'groupes_actifs'       => GroupeCatechese::where('actif', true)->count(),
            'niveaux'              => NiveauFormation::where('actif', true)->count(),
            'examens_total'        => Examen::count(),
        ];

        $catechumenes_recents = Catechumene::orderBy('created_at', 'desc')->take(5)->get();
        $examens_recents = Examen::with('niveauFormation')->orderBy('created_at', 'desc')->take(5)->get();
        $niveaux = NiveauFormation::actif()->withCount('progressions')->get();

        return view('sacrements.dashboard', compact('stats', 'catechumenes_recents', 'examens_recents', 'niveaux'));
    }
}
