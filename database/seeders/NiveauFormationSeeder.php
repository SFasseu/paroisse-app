<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NiveauFormation;

class NiveauFormationSeeder extends Seeder
{
    public function run(): void
    {
        $niveaux = [
            [
                'nom'         => 'Éveil à la foi',
                'description' => 'Premier contact avec la foi chrétienne. Découverte de Dieu, de l\'Église et des bases de la vie chrétienne.',
                'ordre'       => 1,
                'duree_mois'  => 12,
                'age_minimum' => 7,
                'actif'       => true,
            ],
            [
                'nom'         => 'Catéchèse 1ère année',
                'description' => 'Approfondissement des bases de la foi : la Bible, les sacrements, la prière et la vie en communauté.',
                'ordre'       => 2,
                'duree_mois'  => 12,
                'age_minimum' => 8,
                'actif'       => true,
            ],
            [
                'nom'         => 'Catéchèse 2ème année',
                'description' => 'Étude approfondie du Credo, des commandements, de la morale chrétienne et de la liturgie.',
                'ordre'       => 3,
                'duree_mois'  => 12,
                'age_minimum' => 9,
                'actif'       => true,
            ],
            [
                'nom'         => 'Préparation aux sacrements d\'initiation',
                'description' => 'Préparation intensive à la réception du Baptême, de la Première Communion et de la Confirmation.',
                'ordre'       => 4,
                'duree_mois'  => 6,
                'age_minimum' => 10,
                'actif'       => true,
            ],
            [
                'nom'         => 'Formation continue post-sacrement',
                'description' => 'Accompagnement spirituel et formation continue après la réception des sacrements d\'initiation.',
                'ordre'       => 5,
                'duree_mois'  => 12,
                'age_minimum' => 11,
                'actif'       => true,
            ],
        ];

        foreach ($niveaux as $niveau) {
            NiveauFormation::firstOrCreate(['nom' => $niveau['nom']], $niveau);
        }

        $this->command->info('Niveaux de formation créés avec succès.');
    }
}
