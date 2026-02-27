<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Catechiste;
use App\Models\GroupeCatechese;
use App\Models\NiveauFormation;

class GroupeAndCatechisteSeeder extends Seeder
{
    public function run(): void
    {
        // Create catechistes
        $catechiste1 = Catechiste::firstOrCreate(
            ['email' => 'marie.ndongo@paroisse-bepanda.cm'],
            [
                'nom'             => 'Ndongo',
                'prenom'          => 'Marie-Claire',
                'telephone'       => '+237 677 123 456',
                'email'           => 'marie.ndongo@paroisse-bepanda.cm',
                'date_naissance'  => '1985-03-15',
                'date_engagement' => '2015-09-01',
                'specialite'      => 'Niveaux 1 et 2 — Éveil à la foi',
                'actif'           => true,
            ]
        );

        $catechiste2 = Catechiste::firstOrCreate(
            ['email' => 'paul.biya.cat@paroisse-bepanda.cm'],
            [
                'nom'             => 'Biya',
                'prenom'          => 'Paul-Émile',
                'telephone'       => '+237 699 234 567',
                'email'           => 'paul.biya.cat@paroisse-bepanda.cm',
                'date_naissance'  => '1978-11-20',
                'date_engagement' => '2010-01-15',
                'specialite'      => 'Niveaux 3 et 4 — Préparation aux sacrements',
                'actif'           => true,
            ]
        );

        // Create groups
        $niveau1 = NiveauFormation::where('ordre', 1)->first();
        $niveau2 = NiveauFormation::where('ordre', 2)->first();

        if ($niveau1) {
            $groupe1 = GroupeCatechese::firstOrCreate(
                ['nom' => 'Groupe Lumière — Éveil à la foi 2025-2026'],
                [
                    'niveau_formation_id' => $niveau1->id,
                    'nom'                 => 'Groupe Lumière — Éveil à la foi 2025-2026',
                    'annee_pastorale'     => '2025-2026',
                    'lieu_reunion'        => 'Salle Saint-Joseph, Bépanda',
                    'jour_reunion'        => 'samedi',
                    'heure_reunion'       => '09:00',
                    'capacite_max'        => 30,
                    'actif'               => true,
                ]
            );

            $groupe1->catechistes()->syncWithoutDetaching([
                $catechiste1->id => ['role' => 'principal'],
            ]);
        }

        if ($niveau2) {
            $groupe2 = GroupeCatechese::firstOrCreate(
                ['nom' => 'Groupe Espérance — Catéchèse 1ère année 2025-2026'],
                [
                    'niveau_formation_id' => $niveau2->id,
                    'nom'                 => 'Groupe Espérance — Catéchèse 1ère année 2025-2026',
                    'annee_pastorale'     => '2025-2026',
                    'lieu_reunion'        => 'Salle Sainte-Marie, Bépanda',
                    'jour_reunion'        => 'dimanche',
                    'heure_reunion'       => '10:00',
                    'capacite_max'        => 25,
                    'actif'               => true,
                ]
            );

            $groupe2->catechistes()->syncWithoutDetaching([
                $catechiste2->id => ['role' => 'principal'],
                $catechiste1->id => ['role' => 'assistant'],
            ]);
        }

        $this->command->info('Catéchistes et groupes créés avec succès.');
    }
}
