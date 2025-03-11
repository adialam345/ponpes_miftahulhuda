<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = 'admin123';
        $hashedPassword = Hash::make($password);
        
        // Debug log
        Log::info('Creating admin user with password hash: ' . $hashedPassword);
        
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => $hashedPassword,
        ]);
        
        // Debug log
        Log::info('Admin user created successfully');
    }
}
