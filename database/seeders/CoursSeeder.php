<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cours;
use App\Models\NiveauFormation;

class CoursSeeder extends Seeder
{
    public function run(): void
    {
        $coursParNiveau = [
            'Éveil à la foi' => [
                ['titre' => 'Qui est Dieu ?', 'description' => 'Introduction à la notion de Dieu créateur et père aimant.', 'objectifs' => 'Comprendre que Dieu est notre père et qu\'Il nous aime.', 'duree_heures' => 2.0, 'ordre' => 1],
                ['titre' => 'La Bible — Parole de Dieu', 'description' => 'Découverte de la Bible comme Parole vivante de Dieu.', 'objectifs' => 'Connaître la structure de la Bible et ses principaux récits.', 'duree_heures' => 2.0, 'ordre' => 2],
                ['titre' => 'La prière chrétienne', 'description' => 'Apprendre à prier : le Notre Père, le Je vous salue Marie.', 'objectifs' => 'Savoir prier avec les mots de l\'Église.', 'duree_heures' => 1.5, 'ordre' => 3],
                ['titre' => 'L\'Église, communauté de croyants', 'description' => 'Découvrir l\'Église comme famille de Dieu.', 'objectifs' => 'Comprendre le rôle de l\'Église dans la vie du chrétien.', 'duree_heures' => 2.0, 'ordre' => 4],
            ],
            'Catéchèse 1ère année' => [
                ['titre' => 'La Trinité : Père, Fils et Saint-Esprit', 'description' => 'Comprendre le mystère de la Trinité.', 'objectifs' => 'Affirmer sa foi en un Dieu Trinité.', 'duree_heures' => 2.5, 'ordre' => 1],
                ['titre' => 'Jésus-Christ, Fils de Dieu', 'description' => 'La vie, la mort et la résurrection de Jésus-Christ.', 'objectifs' => 'Connaître les grands moments de la vie de Jésus.', 'duree_heures' => 3.0, 'ordre' => 2],
                ['titre' => 'Les sacrements de l\'Église', 'description' => 'Présentation des sept sacrements.', 'objectifs' => 'Identifier les sept sacrements et leur signification.', 'duree_heures' => 2.0, 'ordre' => 3],
                ['titre' => 'Les Dix Commandements', 'description' => 'Étude des commandements de Dieu et leur sens pour la vie chrétienne.', 'objectifs' => 'Mémoriser et comprendre les Dix Commandements.', 'duree_heures' => 2.5, 'ordre' => 4],
            ],
            'Catéchèse 2ème année' => [
                ['titre' => 'Le Credo — Profession de foi', 'description' => 'Étude approfondie du Symbole des Apôtres.', 'objectifs' => 'Réciter et expliquer le Credo.', 'duree_heures' => 3.0, 'ordre' => 1],
                ['titre' => 'La morale chrétienne', 'description' => 'Vivre selon l\'Évangile dans le monde d\'aujourd\'hui.', 'objectifs' => 'Appliquer les valeurs chrétiennes dans la vie quotidienne.', 'duree_heures' => 2.5, 'ordre' => 2],
                ['titre' => 'La liturgie et l\'Eucharistie', 'description' => 'Comprendre la messe et ses différentes parties.', 'objectifs' => 'Participer activement à la liturgie eucharistique.', 'duree_heures' => 2.5, 'ordre' => 3],
                ['titre' => 'Marie et les saints', 'description' => 'Le rôle de Marie et la communion des saints.', 'objectifs' => 'Connaître Marie comme modèle de foi.', 'duree_heures' => 2.0, 'ordre' => 4],
            ],
            'Préparation aux sacrements d\'initiation' => [
                ['titre' => 'Le Baptême : naissance à la vie chrétienne', 'description' => 'Théologie et rite du Baptême.', 'objectifs' => 'Comprendre le sens et les effets du Baptême.', 'duree_heures' => 3.0, 'ordre' => 1],
                ['titre' => 'La Confirmation : don de l\'Esprit', 'description' => 'Théologie et préparation à la Confirmation.', 'objectifs' => 'Se préparer à recevoir le Saint-Esprit.', 'duree_heures' => 3.0, 'ordre' => 2],
                ['titre' => 'L\'Eucharistie : Corps du Christ', 'description' => 'Préparation à la Première Communion.', 'objectifs' => 'Recevoir dignement le Corps du Christ.', 'duree_heures' => 3.0, 'ordre' => 3],
            ],
            'Formation continue post-sacrement' => [
                ['titre' => 'Engagement chrétien dans la société', 'description' => 'Comment vivre sa foi au quotidien.', 'objectifs' => 'Être un témoin du Christ dans la société.', 'duree_heures' => 2.0, 'ordre' => 1],
                ['titre' => 'La vie de prière et les sacrements', 'description' => 'Approfondir sa vie sacramentelle.', 'objectifs' => 'Développer une vie de prière régulière.', 'duree_heures' => 2.0, 'ordre' => 2],
                ['titre' => 'Service et charité', 'description' => 'L\'amour du prochain comme commandement central.', 'objectifs' => 'S\'engager dans des œuvres de charité.', 'duree_heures' => 2.0, 'ordre' => 3],
            ],
        ];

        foreach ($coursParNiveau as $niveauNom => $coursList) {
            $niveau = NiveauFormation::where('nom', $niveauNom)->first();
            if (!$niveau) continue;

            foreach ($coursList as $coursData) {
                Cours::firstOrCreate(
                    ['niveau_formation_id' => $niveau->id, 'titre' => $coursData['titre']],
                    array_merge($coursData, ['niveau_formation_id' => $niveau->id, 'actif' => true])
                );
            }
        }

        $this->command->info('Cours créés avec succès.');
    }
}
