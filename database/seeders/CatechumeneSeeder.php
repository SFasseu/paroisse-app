<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Catechumene;
use App\Models\GroupeCatechese;
use App\Models\NiveauFormation;
use App\Models\ProgressionCatechumene;
use App\Models\ResultatExamen;
use App\Models\Examen;
use App\Models\ParentTuteur;

class CatechumeneSeeder extends Seeder
{
    public function run(): void
    {
        $groupe1 = GroupeCatechese::where('nom', 'like', '%Lumière%')->first();
        $groupe2 = GroupeCatechese::where('nom', 'like', '%Espérance%')->first();

        $niveau1 = NiveauFormation::where('ordre', 1)->first();
        $niveau2 = NiveauFormation::where('ordre', 2)->first();

        $catechumenes = [
            ['nom' => 'Mbarga', 'prenom' => 'Éric', 'sexe' => 'M', 'date_naissance' => '2014-05-10', 'groupe' => $groupe1, 'niveau' => $niveau1],
            ['nom' => 'Olinga', 'prenom' => 'Christelle', 'sexe' => 'F', 'date_naissance' => '2013-08-22', 'groupe' => $groupe1, 'niveau' => $niveau1],
            ['nom' => 'Nkodo', 'prenom' => 'Samuel', 'sexe' => 'M', 'date_naissance' => '2015-01-30', 'groupe' => $groupe1, 'niveau' => $niveau1],
            ['nom' => 'Essomba', 'prenom' => 'Isabelle', 'sexe' => 'F', 'date_naissance' => '2014-11-05', 'groupe' => $groupe1, 'niveau' => $niveau1],
            ['nom' => 'Atangana', 'prenom' => 'Jean-Pierre', 'sexe' => 'M', 'date_naissance' => '2013-03-18', 'groupe' => $groupe1, 'niveau' => $niveau1],
            ['nom' => 'Biyong', 'prenom' => 'Marie-Thérèse', 'sexe' => 'F', 'date_naissance' => '2012-07-25', 'groupe' => $groupe2, 'niveau' => $niveau2],
            ['nom' => 'Mendo', 'prenom' => 'Paul', 'sexe' => 'M', 'date_naissance' => '2012-02-14', 'groupe' => $groupe2, 'niveau' => $niveau2],
            ['nom' => 'Nanga', 'prenom' => 'Florence', 'sexe' => 'F', 'date_naissance' => '2011-09-09', 'groupe' => $groupe2, 'niveau' => $niveau2],
            ['nom' => 'Zang', 'prenom' => 'Emmanuel', 'sexe' => 'M', 'date_naissance' => '2013-06-01', 'groupe' => $groupe2, 'niveau' => $niveau2],
            ['nom' => 'Fouda', 'prenom' => 'Angeline', 'sexe' => 'F', 'date_naissance' => '2012-12-20', 'groupe' => $groupe2, 'niveau' => $niveau2],
        ];

        foreach ($catechumenes as $data) {
            $groupe = $data['groupe'];
            $niveau = $data['niveau'];

            if (!$groupe || !$niveau) continue;

            $catechumene = Catechumene::firstOrCreate(
                ['nom' => $data['nom'], 'prenom' => $data['prenom']],
                [
                    'groupe_catechese_id' => $groupe->id,
                    'date_naissance'      => $data['date_naissance'],
                    'lieu_naissance'      => 'Douala, Cameroun',
                    'sexe'                => $data['sexe'],
                    'nationalite'         => 'Camerounaise',
                    'adresse'             => 'Bépanda, Douala',
                    'telephone'           => '+237 6' . rand(50, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                    'date_inscription'    => '2025-09-15',
                    'statut'              => 'en_cours',
                ]
            );

            // Create parent
            ParentTuteur::firstOrCreate(
                ['catechumene_id' => $catechumene->id, 'lien' => 'mere'],
                [
                    'nom'        => $data['nom'],
                    'prenom'     => 'Maman',
                    'lien'       => 'mere',
                    'telephone'  => '+237 6' . rand(50, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                ]
            );

            // Create progression
            if ($niveau) {
                ProgressionCatechumene::firstOrCreate(
                    ['catechumene_id' => $catechumene->id, 'niveau_formation_id' => $niveau->id],
                    [
                        'date_debut' => '2025-09-15',
                        'statut'     => 'en_cours',
                        'valide'     => false,
                    ]
                );
            }

            // Add some exam results for groupe2
            if ($groupe->id === optional($groupe2)->id) {
                $examen = Examen::whereHas('niveauFormation', fn($q) => $q->where('ordre', 2))
                    ->where('type', 'ecrit')->first();

                if ($examen) {
                    $note = rand(8, 19);
                    ResultatExamen::firstOrCreate(
                        ['catechumene_id' => $catechumene->id, 'examen_id' => $examen->id],
                        [
                            'note_obtenue' => $note,
                            'date_examen'  => '2026-01-15',
                            'statut'       => $note >= $examen->note_passage ? 'reussi' : 'echoue',
                        ]
                    );
                }
            }
        }

        $this->command->info('10 catéchumènes de démo créés avec succès.');
    }
}
