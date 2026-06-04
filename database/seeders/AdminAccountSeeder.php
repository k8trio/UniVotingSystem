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
            ['username' => 'admin'],
            [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'year_and_section' => null,
                'college' => null,
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'has_voted' => false,
                'qr_code' => Str::random(32),
            ]
        );
    }
}