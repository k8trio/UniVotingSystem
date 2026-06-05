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
            ['username' => 'ssc_admin'],
            [
                'student_id' => null,
                'last_name' => 'Administrator',
                'first_name' => 'System',
                'year_and_section' => null,
                'college' => null,
                'password' => Hash::make('ssc@2026!'),
                'role' => 'admin',
                'has_voted' => false,
                'qr_code_token' => Str::random(32),
            ]
        );
    }
}