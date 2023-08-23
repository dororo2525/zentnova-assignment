<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@superadmin.com',
            'phone' => '0123456789',
            'password' => Hash::make('123456'),
            'superadmin' => 1,
        ]);
        // \App\Models\User::factory(10)->create();
        $this->call([
            PackageSeeder::class,
        ]);
    }
}
