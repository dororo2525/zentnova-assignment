<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\UserPackage;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@superadmin.com',
            'phone' => '0123456789',
            'password' => Hash::make('123456'),
            'package_id' => 3,
            'superadmin' => 1,
        ]);

        UserPackage::create([
            'user_id' => $user->id,
            'package_id' => 3,
            'status' => 'pending',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'created_at' => Carbon::now(),
        ]);

        // \App\Models\User::factory(10)->create();
        $this->call([
            PackageSeeder::class,
        ]);
    }
}
