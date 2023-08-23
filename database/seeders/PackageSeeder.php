<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Package::create(
            [
            'name' => 'Free Plan',
            'price' => '0',
            'description' => 'Free Plan',
            'duration' => '30', // 30 days
            'url' => '3', // 10 urls
            ]);
        \App\Models\Package::create([
            'name' => 'Basic Plan',
            'price' => '10',
            'description' => 'Basic Plan',
            'duration' => '30', // 30 days
            'url' => '10', // 10 urls
        ] );
        \App\Models\Package::create([
            'name' => 'Premium Plan',
            'price' => '20',
            'description' => 'Premium Plan',
            'duration' => '120', // 120 days
            'url' => '100', // 100 urls
        ]);
    }
}
