<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\PaymentItem;
use App\Models\PaymentMethod;
use App\Models\PaymentSystem;
use App\Models\MassIntention;
use App\Models\Article;
use App\Models\Parking;
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
        // Créer les systèmes de paiement
        $cash = PaymentSystem::firstOrCreate([
            'code' => 'cash',
        ], [
            'name' => 'Espèces',
            'description' => 'Paiement en espèces',
            'is_active' => true,
        ]);

        $mobileSystem = PaymentSystem::firstOrCreate([
            'code' => 'mobile_money',
        ], [
            'name' => 'Mobile Money',
            'description' => 'Paiement par mobile',
            'is_active' => true,
        ]);

        $bankSystem = PaymentSystem::firstOrCreate([
            'code' => 'bank',
        ], [
            'name' => 'Banque',
            'description' => 'Paiement par virement bancaire',
            'is_active' => true,
        ]);

        $checkSystem = PaymentSystem::firstOrCreate([
            'code' => 'check',
        ], [
            'name' => 'Chèque',
            'description' => 'Paiement par chèque',
            'is_active' => true,
        ]);

        // Créer les méthodes de paiement
        $methods = [
            PaymentMethod::firstOrCreate([
                'code' => 'liquide',
            ], [
                'payment_system_id' => $cash->id,
                'name' => 'Liquide',
                'description' => 'Paiement en liquide',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
                'is_active' => true,
            ]),

            PaymentMethod::firstOrCreate([
                'code' => 'orange_money',
            ], [
                'payment_system_id' => $mobileSystem->id,
                'name' => 'Orange Money',
                'description' => 'Paiement via Orange Money',
                'fee_percentage' => 1.5,
                'fee_fixed' => 25,
                'is_active' => true,
            ]),

            PaymentMethod::firstOrCreate([
                'code' => 'mtn_money',
            ], [
                'payment_system_id' => $mobileSystem->id,
                'name' => 'MTN Money',
                'description' => 'Paiement via MTN Money',
                'fee_percentage' => 1.5,
                'fee_fixed' => 25,
                'is_active' => true,
            ]),

            PaymentMethod::firstOrCreate([
                'code' => 'bank_transfer',
            ], [
                'payment_system_id' => $bankSystem->id,
                'name' => 'Virement UCEC',
                'description' => 'Virement bancaire',
                'fee_percentage' => 0.5,
                'fee_fixed' => 0,
                'is_active' => true,
            ]),

            PaymentMethod::firstOrCreate([
                'code' => 'check',
            ], [
                'payment_system_id' => $checkSystem->id,
                'name' => 'Chèque',
                'description' => 'Paiement par chèque',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
                'is_active' => true,
            ]),
        ];

        $statuses = ['pending', 'confirmed', 'cancelled'];
        
        $user = User::first() ?? User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@paroisse.com',
            'password' => bcrypt('password'),
        ]);

        // Charger les items d'intention, articles et parking
        $massIntentions = MassIntention::all();
        $articles = Article::all();
        $parkings = Parking::all();

        // Créer 20 paiements avec des items variés
        for ($i = 1; $i <= 20; $i++) {
            $payment = Payment::create([
                'user_id' => $user->id,
                'payment_method_id' => $methods[array_rand($methods)]->id,
                'amount' => 0, // Sera calculé depuis les items
                'currency' => 'XAF',
                'status' => $statuses[array_rand($statuses)],
                'description' => 'Paiement test #' . $i,
                'reference_number' => 'REF-' . date('Ymd') . '-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'payment_date' => now()->subDays(rand(1, 30)),
                'notes' => 'Données de test',
            ]);

            // Décider du type de paiement et ajouter les items correspondants
            $paymentType = rand(1, 3);
            $totalAmount = 0;

            if ($paymentType === 1 && $massIntentions->count() > 0) {
                // Paiement pour intention de messe
                $intention = $massIntentions->random();
                $quantity = rand(1, 3);
                $amount = $intention->suggested_amount * $quantity;
                
                PaymentItem::create([
                    'payment_id' => $payment->id,
                    'itemable_type' => MassIntention::class,
                    'itemable_id' => $intention->id,
                    'amount' => $amount,
                    'quantity' => $quantity,
                    'description' => $quantity . 'x ' . $intention->name,
                ]);
                
                $totalAmount = $amount;
            } elseif ($paymentType === 2 && $articles->count() > 0) {
                // Paiement pour article(s)
                $articleCount = rand(1, 3);
                for ($j = 0; $j < $articleCount; $j++) {
                    $article = $articles->random();
                    $quantity = rand(1, 2);
                    $amount = $article->price * $quantity;
                    
                    PaymentItem::create([
                        'payment_id' => $payment->id,
                        'itemable_type' => Article::class,
                        'itemable_id' => $article->id,
                        'amount' => $amount,
                        'quantity' => $quantity,
                        'description' => $quantity . 'x ' . $article->name,
                    ]);
                    
                    $totalAmount += $amount;
                }
            } elseif ($paymentType === 3 && $parkings->count() > 0) {
                // Paiement pour parking
                $parking = $parkings->random();
                $amount = $parking->daily_rate;
                
                PaymentItem::create([
                    'payment_id' => $payment->id,
                    'itemable_type' => Parking::class,
                    'itemable_id' => $parking->id,
                    'amount' => $amount,
                    'quantity' => 1,
                    'description' => 'Stationnement - ' . $parking->location,
                ]);
                
                $totalAmount = $amount;
            }

            // Mettre à jour le montant du paiement
            $payment->update(['amount' => $totalAmount]);
        }
    }
}
