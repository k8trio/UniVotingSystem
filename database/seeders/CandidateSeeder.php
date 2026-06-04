<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Position;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'President',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Santos', 'first_name' => 'Maria Angela', 'college' => 'CASL'],
                    ['last_name' => 'Reyes', 'first_name' => 'Carlo Miguel', 'college' => 'CBPA'],
                    ['last_name' => 'Dela Cruz', 'first_name' => 'Juan Paolo', 'college' => 'CCS'],
                ],
            ],

            [
                'name' => 'Executive Vice President',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Garcia', 'first_name' => 'Sofia Mae', 'college' => 'CTE'],
                    ['last_name' => 'Mendoza', 'first_name' => 'Adrian James', 'college' => 'CIT'],
                    ['last_name' => 'Bautista', 'first_name' => 'Nicole Anne', 'college' => 'CTHM'],
                ],
            ],

            [
                'name' => 'Vice President for Students’ Right and Welfare',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Torres', 'first_name' => 'Hannah Claire', 'college' => 'CASL'],
                    ['last_name' => 'Ramos', 'first_name' => 'Christian Dale', 'college' => 'CCS'],
                ],
            ],

            [
                'name' => 'Vice President for Projects and Activities',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Flores', 'first_name' => 'Erika Louise', 'college' => 'CBPA'],
                    ['last_name' => 'Castillo', 'first_name' => 'John Mark', 'college' => 'CIT'],
                ],
            ],

            [
                'name' => 'Vice President for Communications',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Aquino', 'first_name' => 'Patricia Joy', 'college' => 'CTE'],
                    ['last_name' => 'Navarro', 'first_name' => 'Kyle Matthew', 'college' => 'CCS'],
                ],
            ],

            [
                'name' => 'Vice President for Marketing and Creatives',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Villanueva', 'first_name' => 'Andrea Faith', 'college' => 'CTHM'],
                    ['last_name' => 'Lopez', 'first_name' => 'Daniel Angelo', 'college' => 'CASL'],
                ],
            ],

            [
                'name' => 'Executive Secretary',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Fernandez', 'first_name' => 'Alyssa Marie', 'college' => 'CCS'],
                    ['last_name' => 'Cruz', 'first_name' => 'Rafael Luis', 'college' => 'CBPA'],
                ],
            ],

            [
                'name' => 'Deputy Secretary',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Morales', 'first_name' => 'Janelle Rose', 'college' => 'CTE'],
                    ['last_name' => 'Perez', 'first_name' => 'Miguel Antonio', 'college' => 'CIT'],
                ],
            ],

            [
                'name' => 'Treasurer',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Domingo', 'first_name' => 'Carla Beatrice', 'college' => 'CBPA'],
                    ['last_name' => 'Gonzales', 'first_name' => 'Ivan Joseph', 'college' => 'CCS'],
                ],
            ],

            [
                'name' => 'Sub-Treasurer',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Rivera', 'first_name' => 'Trisha Mae', 'college' => 'CTHM'],
                    ['last_name' => 'Salazar', 'first_name' => 'Mark Vincent', 'college' => 'CASL'],
                ],
            ],

            [
                'name' => 'Auditor',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Mercado', 'first_name' => 'Justine Claire', 'college' => 'CIT'],
                    ['last_name' => 'Francisco', 'first_name' => 'Ella Grace', 'college' => 'CTE'],
                ],
            ],

            [
                'name' => 'Business Manager',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 2,
                'candidates' => [
                    ['last_name' => 'Lim', 'first_name' => 'Joshua Andrei', 'college' => 'CCS'],
                    ['last_name' => 'Tan', 'first_name' => 'Samantha Nicole', 'college' => 'CBPA'],
                    ['last_name' => 'Ocampo', 'first_name' => 'Vince Gabriel', 'college' => 'CIT'],
                    ['last_name' => 'Sy', 'first_name' => 'Camille Denise', 'college' => 'CTHM'],
                ],
            ],

            [
                'name' => 'Press Relations Officer',
                'department' => 'executive',
                'college' => null,
                'max_winners' => 2,
                'candidates' => [
                    ['last_name' => 'Del Rosario', 'first_name' => 'Mikaela Jane', 'college' => 'CASL'],
                    ['last_name' => 'Aguilar', 'first_name' => 'Sean Patrick', 'college' => 'CCS'],
                    ['last_name' => 'Padilla', 'first_name' => 'Krystal Anne', 'college' => 'CTE'],
                    ['last_name' => 'Marquez', 'first_name' => 'Benedict Paul', 'college' => 'CBPA'],
                ],
            ],

            [
                'name' => 'House Speaker',
                'department' => 'legislative',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Soriano', 'first_name' => 'Gabriel James', 'college' => 'CASL'],
                    ['last_name' => 'Velasco', 'first_name' => 'Mia Therese', 'college' => 'CCS'],
                ],
            ],

            [
                'name' => 'Deputy House Speaker',
                'department' => 'legislative',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Alvarez', 'first_name' => 'Cedrick John', 'college' => 'CIT'],
                    ['last_name' => 'Luna', 'first_name' => 'Princess Mae', 'college' => 'CTE'],
                ],
            ],

            [
                'name' => 'Legislative Secretary',
                'department' => 'legislative',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Pascual', 'first_name' => 'Rhea Camille', 'college' => 'CBPA'],
                    ['last_name' => 'Valdez', 'first_name' => 'Nathaniel Cruz', 'college' => 'CTHM'],
                ],
            ],

            [
                'name' => 'CASL Governor',
                'department' => 'legislative',
                'college' => 'CASL',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Casal', 'first_name' => 'Renee Anne', 'college' => 'CASL'],
                    ['last_name' => 'Manalo', 'first_name' => 'Arvin Jake', 'college' => 'CASL'],
                ],
            ],

            [
                'name' => 'CASL Vice Governor',
                'department' => 'legislative',
                'college' => 'CASL',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Belen', 'first_name' => 'Camille Joy', 'college' => 'CASL'],
                    ['last_name' => 'Serrano', 'first_name' => 'Luis Miguel', 'college' => 'CASL'],
                ],
            ],

            [
                'name' => 'CBPA Governor',
                'department' => 'legislative',
                'college' => 'CBPA',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Buenaventura', 'first_name' => 'Carla Mae', 'college' => 'CBPA'],
                    ['last_name' => 'Macaraeg', 'first_name' => 'Jomar Luis', 'college' => 'CBPA'],
                ],
            ],

            [
                'name' => 'CBPA Vice Governor',
                'department' => 'legislative',
                'college' => 'CBPA',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Galvez', 'first_name' => 'Irene Faith', 'college' => 'CBPA'],
                    ['last_name' => 'Abad', 'first_name' => 'Patrick Ryan', 'college' => 'CBPA'],
                ],
            ],

            [
                'name' => 'CCS Governor',
                'department' => 'legislative',
                'college' => 'CCS',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Tolentino', 'first_name' => 'Erika Mae', 'college' => 'CCS'],
                    ['last_name' => 'De Vera', 'first_name' => 'Aaron James', 'college' => 'CCS'],
                ],
            ],

            [
                'name' => 'CCS Vice Governor',
                'department' => 'legislative',
                'college' => 'CCS',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Mallari', 'first_name' => 'Hazel Grace', 'college' => 'CCS'],
                    ['last_name' => 'Corpuz', 'first_name' => 'Jan Michael', 'college' => 'CCS'],
                ],
            ],

            [
                'name' => 'CIT Governor',
                'department' => 'legislative',
                'college' => 'CIT',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Pineda', 'first_name' => 'Ralph Christian', 'college' => 'CIT'],
                    ['last_name' => 'Natividad', 'first_name' => 'Joyce Ann', 'college' => 'CIT'],
                ],
            ],

            [
                'name' => 'CIT Vice Governor',
                'department' => 'legislative',
                'college' => 'CIT',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Rosales', 'first_name' => 'Kent Adrian', 'college' => 'CIT'],
                    ['last_name' => 'Antonio', 'first_name' => 'Loraine Mae', 'college' => 'CIT'],
                ],
            ],

            [
                'name' => 'CTE Governor',
                'department' => 'legislative',
                'college' => 'CTE',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Estrella', 'first_name' => 'Marco Angelo', 'college' => 'CTE'],
                    ['last_name' => 'Manzano', 'first_name' => 'Claire Denise', 'college' => 'CTE'],
                ],
            ],

            [
                'name' => 'CTE Vice Governor',
                'department' => 'legislative',
                'college' => 'CTE',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Cabral', 'first_name' => 'Josephine Mae', 'college' => 'CTE'],
                    ['last_name' => 'David', 'first_name' => 'Ron Gabriel', 'college' => 'CTE'],
                ],
            ],

            [
                'name' => 'CTHM Governor',
                'department' => 'legislative',
                'college' => 'CTHM',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Samson', 'first_name' => 'Alyssa Jane', 'college' => 'CTHM'],
                    ['last_name' => 'Yap', 'first_name' => 'Cedric Lance', 'college' => 'CTHM'],
                ],
            ],

            [
                'name' => 'CTHM Vice Governor',
                'department' => 'legislative',
                'college' => 'CTHM',
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Villamor', 'first_name' => 'Angelica Rose', 'college' => 'CTHM'],
                    ['last_name' => 'Chua', 'first_name' => 'Francis Neil', 'college' => 'CTHM'],
                ],
            ],

            [
                'name' => 'Mayor’s League Chairperson',
                'department' => 'legislative',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Cabrera', 'first_name' => 'Vincent Leo', 'college' => 'CCS'],
                    ['last_name' => 'Ignacio', 'first_name' => 'Clarisse Mae', 'college' => 'CASL'],
                ],
            ],

            [
                'name' => 'Mayor’s League Co-Chairperson',
                'department' => 'legislative',
                'college' => null,
                'max_winners' => 1,
                'candidates' => [
                    ['last_name' => 'Montemayor', 'first_name' => 'Kevin John', 'college' => 'CBPA'],
                    ['last_name' => 'Santiago', 'first_name' => 'Bella Francesca', 'college' => 'CTE'],
                ],
            ],
        ];

        foreach ($data as $index => $positionData) {
            $position = Position::updateOrCreate(
                ['name' => $positionData['name']],
                [
                    'department' => $positionData['department'],
                    'college' => $positionData['college'],
                    'max_winners' => $positionData['max_winners'],
                    'display_order' => $index + 1,
                ]
            );

            foreach ($positionData['candidates'] as $candidateData) {
                Candidate::updateOrCreate(
                    [
                        'position_id' => $position->id,
                        'last_name' => $candidateData['last_name'],
                        'first_name' => $candidateData['first_name'],
                    ],
                    [
                        'college' => $candidateData['college'],
                        'partylist' => $candidateData['partylist'] ?? null,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}