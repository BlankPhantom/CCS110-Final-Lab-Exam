<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RehashPasswordsSeeder extends Seeder {
    public function run() {
        foreach (User::all() as $user) {
            // Skip if the password does not need rehashing
            if (!Hash::needsRehash($user->password)) {
                continue;
            }
            $user->password = Hash::make($user->password);
            $user->save();
        }
    }
}