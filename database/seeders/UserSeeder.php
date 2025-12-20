<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Master Admin',
            'role_id' => 1,
            'email' => 'masteradmin@gmail.com',
            'contact' => '1234567890',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
    }
}
