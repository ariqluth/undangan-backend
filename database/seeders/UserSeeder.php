<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "SuperAdmin",
            'email' => "superadmin@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "Employee",
            'email' => "employe@gmail.com",
            'password' => Hash::make('@password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "Customer",
            'email' => "customer@gmail.com",
            'password' => Hash::make('@password'),
            'email_verified_at' => now(),
        ]);
      
        User::create([
            'name' => "mobile",
            'email' => "mobile@gmail.com",
            'password' => Hash::make('@password'),
            'email_verified_at' => now(),
        ]);
      
    }
}