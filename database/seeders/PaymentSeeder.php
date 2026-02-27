<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['tithe', 'donation', 'offering', 'service'];
        $methods = ['cash', 'mobile_money', 'bank_transfer', 'check'];
        $statuses = ['pending', 'confirmed', 'cancelled'];
        
        $user = User::first() ?? User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@paroisse.com',
            'password' => bcrypt('password'),
        ]);

        for ($i = 1; $i <= 20; $i++) {
            Payment::create([
                'user_id' => $user->id,
                'payment_type' => $types[array_rand($types)],
                'amount' => rand(10000, 500000),
                'currency' => 'XAF',
                'payment_method' => $methods[array_rand($methods)],
                'status' => $statuses[array_rand($statuses)],
                'description' => 'Paiement test #' . $i,
                'reference_number' => 'REF-' . date('Ymd') . '-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'payment_date' => now()->subDays(rand(1, 30)),
                'notes' => 'Données de test',
            ]);
        }
    }
}
