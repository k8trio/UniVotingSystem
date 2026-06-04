<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['student_id' => '23-LN-5358'],
            [
                'username' => null,
                'first_name' => 'Kate Diane',
                'last_name' => 'Inoue',
                'year_and_section' => 'III-BSIT-B',
                'college' => 'CCS',
                'password' => Hash::make('password123'),
                'role' => 'voter',
                'has_voted' => false,
                'qr_code' => Str::random(32),
            ]
        );
    }
}
