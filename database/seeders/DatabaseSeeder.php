<?php

namespace Database\Seeders;

use App\Models\Developer\AdvancedCrud;
use App\Models\Developer\CrudWithSort;
use App\Models\Developer\SimpleCrud;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Simple Crud
        for ($i = 1; $i <= 15; $i++) {
            SimpleCrud::create([
                'name' => "Sample Item $i",
                'details' => "This is a detailed description for sample item $i.",
                'is_active' => rand(0, 1),
                'order' => $i,
            ]);
        }

        // Advanced Crud
        $types = ['customer', 'guardian'];
        $genders = ['male', 'female'];
        for ($i = 1; $i <= 20; $i++) {
            AdvancedCrud::create([
                'type' => $types[array_rand($types)],
                'name' => "Customer Name $i",
                'email' => "customer$i@example.com",
                'mobile' => "050" . rand(1000000, 9999999),
                'civil_id' => "2" . rand(10000000000, 99999999999),
                'gender' => $genders[array_rand($genders)],
                'dob' => now()->subYears(rand(18, 50))->subDays(rand(1, 365)),
                'password' => Hash::make('password123'),
                'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                'address' => "Street $i, Block " . rand(1, 10) . ", City",
                'profession' => "Profession $i",
                'is_vip' => rand(0, 1) == 1,
                'banned_at' => rand(0, 10) > 8 ? now() : null,
            ]);
        }

        // Crud With Sort
        $durations = [
            ['name' => '1 Month', 'days' => 30],
            ['name' => '3 Months', 'days' => 90],
            ['name' => '6 Months', 'days' => 180],
            ['name' => '1 Year', 'days' => 365],
            ['name' => 'Lifetime', 'days' => 36500],
        ];

        foreach ($durations as $index => $duration) {
            CrudWithSort::create([
                'name' => $duration['name'],
                'days' => $duration['days'],
                'order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
