<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Admin",
            'email' => "admin@email.com",
            'password' => Hash::make("admin"),
            'role' => 1,
        ]);
        User::create([
            'name' => "Store Keeper",
            'email' => "storekeeper@email.com",
            'password' => Hash::make("storekeeper"),
            'role' => 2,
        ]);
        User::create([
            'name' => "Cashier",
            'email' => "cashier@email.com",
            'password' => Hash::make("cashier"),
            'role' => 3,
        ]);
        User::create([
            'name' => "Cashier 2",
            'email' => "cashier2@email.com",
            'password' => Hash::make("cashier"),
            'role' => 3,
        ]);
    }
}
