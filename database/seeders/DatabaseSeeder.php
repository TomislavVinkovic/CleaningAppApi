<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'tvinkovi',
            'email' => 'tvinkovi@mathos.hr',
            'first_name' => 'Tomislav',
            'last_name' => 'Vinković',
            'phone_number' => '+385953935731',
            'email_verified_at' => now(),
            'password' => Hash::make('Testko123!'),
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole(Role::ADMIN);
    }
}
