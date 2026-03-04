<?php

namespace Database\Seeders;

use App\Models\MassIntention;
use App\Models\Article;
use App\Models\Parking;
use Illuminate\Database\Seeder;

class MassIntentionSeeder extends Seeder
{
    public function run(): void
    {
        MassIntention::firstOrCreate([
            'name' => 'La Dîme Hebdomadaire',
        ], [
            'description' => 'Contribution hebdomadaire pour le fonctionnement de la paroisse',
            'suggested_amount' => 5000,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        MassIntention::firstOrCreate([
            'name' => 'Messe pour les Défunts',
        ], [
            'description' => 'Intention de messe pour les âmes défuntes',
            'suggested_amount' => 10000,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        MassIntention::firstOrCreate([
            'name' => 'Messe de Gratitude',
        ], [
            'description' => 'Messe en action de grâce pour une bénédiction reçue',
            'suggested_amount' => 15000,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        MassIntention::firstOrCreate([
            'name' => 'Messe de Prière',
        ], [
            'description' => 'Messe pour une intention particulière de prière',
            'suggested_amount' => 8000,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        MassIntention::firstOrCreate([
            'name' => 'Messe Anniversaire',
        ], [
            'description' => 'Messe anniversaire pour un membre de la communauté',
            'suggested_amount' => 20000,
            'currency' => 'XAF',
            'is_active' => true,
        ]);
    }
}
