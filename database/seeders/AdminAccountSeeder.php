<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminAccountSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['student_id' => 'admin'],
            [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'name' => 'System Administrator',
                'email' => 'admin@univote.local',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'has_voted' => false,
                'qr_code_token' => Str::random(32),
                'qr_verified' => true,
                'qr_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['student_id' => '23-LN-0001'],
            [
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'year_and_section' => '3-BSIT-A',
                'college' => 'CCS',
                'name' => 'Juan Dela Cruz',
                'email' => '23-LN-0001@univote.local',
                'password' => Hash::make('password123'),
                'role' => 'voter',
                'has_voted' => false,
                'qr_code_token' => Str::random(32),
            ]
        );
    }
}