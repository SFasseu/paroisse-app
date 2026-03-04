<?php

namespace Database\Seeders;

use App\Models\Parking;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    public function run(): void
    {
        Parking::firstOrCreate([
            'location' => 'Parking Principal',
        ], [
            'total_spaces' => 50,
            'available_spaces' => 45,
            'hourly_rate' => 1000,
            'daily_rate' => 5000,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        Parking::firstOrCreate([
            'location' => 'Parking Handicapés',
        ], [
            'total_spaces' => 5,
            'available_spaces' => 5,
            'hourly_rate' => 500,
            'daily_rate' => 2000,
            'currency' => 'XAF',
            'is_active' => true,
        ]);

        Parking::firstOrCreate([
            'location' => 'Parking Visiteurs',
        ], [
            'total_spaces' => 30,
            'available_spaces' => 25,
            'hourly_rate' => 1500,
            'daily_rate' => 7000,
            'currency' => 'XAF',
            'is_active' => true,
        ]);
    }
}
