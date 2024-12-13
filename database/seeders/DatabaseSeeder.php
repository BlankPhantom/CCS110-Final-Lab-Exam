<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => Hash::make('password')]
        );

    
        User::updateOrCreate(
            ['email' => 'cathbello@gmail.com'],
            ['name' => 'Catherine', 'password' => Hash::make('cath123')]
        );
    }
}
