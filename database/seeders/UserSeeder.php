<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'student_id' => '23-LN-5358',
                'first_name' => 'Kate Diane',
                'last_name' => 'Inoue',
                'year_and_section' => 'III-BSIT-B',
                'college' => 'CCS',
            ],
            [
                'student_id' => '23-LN-0001',
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'year_and_section' => 'III-BSMATH-A',
                'college' => 'CCS',
            ],
            [
                'student_id' => '23-LN-0002',
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'year_and_section' => 'II-ABEL-B',
                'college' => 'CASL',
            ],
            [
                'student_id' => '23-LN-0003',
                'first_name' => 'Carlo',
                'last_name' => 'Reyes',
                'year_and_section' => 'IV-BPA-A',
                'college' => 'CBPA',
            ],
            [
                'student_id' => '23-LN-0004',
                'first_name' => 'Nina',
                'last_name' => 'Garcia',
                'year_and_section' => 'III-BSED-C',
                'college' => 'CTE',
            ],
            [
                'student_id' => '23-LN-0005',
                'first_name' => 'Adrian',
                'last_name' => 'Mendoza',
                'year_and_section' => 'III-BIT-A',
                'college' => 'CIT',
            ],
            [
                'student_id' => '23-LN-0006',
                'first_name' => 'Samantha',
                'last_name' => 'Hernandez',
                'year_and_section' => 'II-BSHM-A',
                'college' => 'CTHM',
            ],
            [
                'student_id' => '23-LN-0007',
                'first_name' => 'Angela',
                'last_name' => 'Torres',
                'year_and_section' => 'I-BSIT-C',
                'college' => 'CCS',
            ],
            [
                'student_id' => '23-LN-0008',
                'first_name' => 'Mark',
                'last_name' => 'Castillo',
                'year_and_section' => 'IV-BSIT-B',
                'college' => 'CCS',
            ],
            [
                'student_id' => '23-LN-0009',
                'first_name' => 'Erika',
                'last_name' => 'Flores',
                'year_and_section' => 'III-BSBA-B',
                'college' => 'CBPA',
            ],
            [
                'student_id' => '23-LN-0010',
                'first_name' => 'Patricia',
                'last_name' => 'Aquino',
                'year_and_section' => 'II-BSED-A',
                'college' => 'CTE',
            ],
            [
                'student_id' => '23-LN-0011',
                'first_name' => 'Kyle',
                'last_name' => 'Navarro',
                'year_and_section' => 'III-BSCS-A',
                'college' => 'CCS',
            ],
            [
                'student_id' => '23-LN-0012',
                'first_name' => 'Andrea',
                'last_name' => 'Villanueva',
                'year_and_section' => 'I-BSHM-B',
                'college' => 'CTHM',
            ],
            [
                'student_id' => '23-LN-0013',
                'first_name' => 'Daniel',
                'last_name' => 'Lopez',
                'year_and_section' => 'II-BSSW-A',
                'college' => 'CASL',
            ],
            [
                'student_id' => '23-LN-0014',
                'first_name' => 'Alyssa',
                'last_name' => 'Fernandez',
                'year_and_section' => 'III-BSMATH-B',
                'college' => 'CCS',
            ],
            [
                'student_id' => '23-LN-0015',
                'first_name' => 'Rafael',
                'last_name' => 'Cruz',
                'year_and_section' => 'IV-BSBA-C',
                'college' => 'CBPA',
            ],
            [
                'student_id' => '23-LN-0016',
                'first_name' => 'Janelle',
                'last_name' => 'Morales',
                'year_and_section' => 'II-BSED-B',
                'college' => 'CTE',
            ],
            [
                'student_id' => '23-LN-0017',
                'first_name' => 'Miguel',
                'last_name' => 'Perez',
                'year_and_section' => 'III-BSTLED-A',
                'college' => 'CIT',
            ],
            [
                'student_id' => '23-LN-0018',
                'first_name' => 'Carla',
                'last_name' => 'Domingo',
                'year_and_section' => 'IV-BSBA-A',
                'college' => 'CBPA',
            ],
            [
                'student_id' => '23-LN-0019',
                'first_name' => 'Ivan',
                'last_name' => 'Gonzales',
                'year_and_section' => 'II-BSIT-C',
                'college' => 'CCS',
            ],
            [
                'student_id' => '23-LN-0020',
                'first_name' => 'Trisha',
                'last_name' => 'Rivera',
                'year_and_section' => 'III-BSTM-A',
                'college' => 'CTHM',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['student_id' => $user['student_id']],
                [
                    'username' => null,
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'year_and_section' => $user['year_and_section'],
                    'college' => $user['college'],
                    'password' => Hash::make('password123'),
                    'role' => 'voter',
                    'has_voted' => false,
                    'voted_at' => null,
                    'qr_code_token' => Str::random(32),
                ]
            );
        }
    }
}