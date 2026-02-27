<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Examen;
use App\Models\NiveauFormation;

class ExamenSeeder extends Seeder
{
    public function run(): void
    {
        $examensParNiveau = [
            'Éveil à la foi' => [
                ['titre' => 'Examen intermédiaire — Éveil à la foi', 'description' => 'Évaluation à mi-parcours du niveau Éveil à la foi.', 'type' => 'oral', 'note_maximale' => 20, 'note_passage' => 10, 'date_examen' => '2026-06-15'],
                ['titre' => 'Examen de fin — Éveil à la foi', 'description' => 'Évaluation finale du niveau Éveil à la foi.', 'type' => 'ecrit', 'note_maximale' => 20, 'note_passage' => 10, 'date_examen' => '2026-11-20'],
            ],
            'Catéchèse 1ère année' => [
                ['titre' => 'Examen intermédiaire — Catéchèse 1ère année', 'description' => 'Évaluation à mi-parcours de la 1ère année.', 'type' => 'ecrit', 'note_maximale' => 20, 'note_passage' => 10, 'date_examen' => '2026-06-20'],
                ['titre' => 'Examen de fin — Catéchèse 1ère année', 'description' => 'Évaluation finale de la 1ère année de catéchèse.', 'type' => 'mixte', 'note_maximale' => 20, 'note_passage' => 12, 'date_examen' => '2026-11-25'],
            ],
            'Catéchèse 2ème année' => [
                ['titre' => 'Examen intermédiaire — Catéchèse 2ème année', 'description' => 'Évaluation à mi-parcours de la 2ème année.', 'type' => 'ecrit', 'note_maximale' => 20, 'note_passage' => 10, 'date_examen' => '2026-06-22'],
                ['titre' => 'Examen de fin — Catéchèse 2ème année', 'description' => 'Évaluation finale de la 2ème année de catéchèse.', 'type' => 'mixte', 'note_maximale' => 20, 'note_passage' => 12, 'date_examen' => '2026-11-28'],
            ],
            'Préparation aux sacrements d\'initiation' => [
                ['titre' => 'Évaluation préparation aux sacrements', 'description' => 'Évaluation globale avant la réception des sacrements.', 'type' => 'oral', 'note_maximale' => 20, 'note_passage' => 14, 'date_examen' => '2026-04-10'],
            ],
            'Formation continue post-sacrement' => [
                ['titre' => 'Bilan formation continue', 'description' => 'Bilan de la formation post-sacrement.', 'type' => 'pratique', 'note_maximale' => 20, 'note_passage' => 10, 'date_examen' => '2026-11-30'],
            ],
        ];

        foreach ($examensParNiveau as $niveauNom => $examensList) {
            $niveau = NiveauFormation::where('nom', $niveauNom)->first();
            if (!$niveau) continue;

            foreach ($examensList as $examenData) {
                Examen::firstOrCreate(
                    ['niveau_formation_id' => $niveau->id, 'titre' => $examenData['titre']],
                    array_merge($examenData, ['niveau_formation_id' => $niveau->id, 'actif' => true])
                );
            }
        }

        $this->command->info('Examens créés avec succès.');
    }
}
