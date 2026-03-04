<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::firstOrCreate([
            'name' => 'Cierge (petit)',
        ], [
            'description' => 'Petit cierge pour les intentions personnelles',
            'price' => 1000,
            'quantity_available' => 100,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        Article::firstOrCreate([
            'name' => 'Cierge (grand)',
        ], [
            'description' => 'Grand cierge pour les rassemblements',
            'price' => 2500,
            'quantity_available' => 50,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        Article::firstOrCreate([
            'name' => 'Livres de Prière',
        ], [
            'description' => 'Recueil de prières et méditations',
            'price' => 5000,
            'quantity_available' => 30,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        Article::firstOrCreate([
            'name' => 'Icône Religieuse',
        ], [
            'description' => 'Icône sainte pour la maison',
            'price' => 8000,
            'quantity_available' => 20,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        Article::firstOrCreate([
            'name' => 'Chapelet Bénit',
        ], [
            'description' => 'Chapelet bénit à l\'église',
            'price' => 3500,
            'quantity_available' => 80,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        Article::firstOrCreate([
            'name' => 'Eau Bénite',
        ], [
            'description' => 'Eau bénite pour la maison',
            'price' => 500,
            'quantity_available' => 200,
            'currency' => 'XAF',
            'is_active' => true,
        ]);
    }
}
