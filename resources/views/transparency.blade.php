<x-layout>
    @php
        $stats = [
            ['num' => '1,847', 'label' => 'Registered Voters', 'color' => 'var(--gold)'],
            ['num' => '1,203', 'label' => 'Votes Cast', 'color' => '#90ffcc'],
            ['num' => '65.1%', 'label' => 'Turnout', 'color' => 'var(--gold-light)'],
            ['num' => '644', 'label' => 'Not Yet Voted', 'color' => '#ffaaaa'],
        ];

        $results = [
            'President' => [
                ['name' => 'Santos, Maria Angela', 'college' => 'CASL', 'percent' => 42],
                ['name' => 'Reyes, Carlo Miguel', 'college' => 'CBPA', 'percent' => 33],
                ['name' => 'Dela Cruz, Juan Paolo', 'college' => 'CCS', 'percent' => 25],
            ],

            'Executive Vice President' => [
                ['name' => 'Garcia, Sofia Mae', 'college' => 'CTE', 'percent' => 51],
                ['name' => 'Mendoza, Adrian James', 'college' => 'CIT', 'percent' => 29],
                ['name' => 'Bautista, Nicole Anne', 'college' => 'CTHM', 'percent' => 20],
            ],

            'VP for Students’ Right and Welfare' => [
                ['name' => 'Torres, Hannah Claire', 'college' => 'CASL', 'percent' => 55],
                ['name' => 'Ramos, Christian Dale', 'college' => 'CCS', 'percent' => 45],
            ],

            'VP for Projects and Activities' => [
                ['name' => 'Flores, Erika Louise', 'college' => 'CBPA', 'percent' => 48],
                ['name' => 'Castillo, John Mark', 'college' => 'CIT', 'percent' => 52],
            ],

            'VP for Communications' => [
                ['name' => 'Aquino, Patricia Joy', 'college' => 'CTE', 'percent' => 50],
                ['name' => 'Navarro, Kyle Matthew', 'college' => 'CCS', 'percent' => 50],
            ],

            'VP for Marketing and Creatives' => [
                ['name' => 'Villanueva, Andrea Faith', 'college' => 'CTHM', 'percent' => 47],
                ['name' => 'Lopez, Daniel Angelo', 'college' => 'CASL', 'percent' => 53],
            ],

            'Executive Secretary' => [
                ['name' => 'Fernandez, Alyssa Marie', 'college' => 'CCS', 'percent' => 58],
                ['name' => 'Cruz, Rafael Luis', 'college' => 'CBPA', 'percent' => 42],
            ],

            'Deputy Secretary' => [
                ['name' => 'Morales, Janelle Rose', 'college' => 'CTE', 'percent' => 46],
                ['name' => 'Perez, Miguel Antonio', 'college' => 'CIT', 'percent' => 54],
            ],

            'Treasurer' => [
                ['name' => 'Domingo, Carla Beatrice', 'college' => 'CBPA', 'percent' => 61],
                ['name' => 'Gonzales, Ivan Joseph', 'college' => 'CCS', 'percent' => 39],
            ],

            'Sub-Treasurer' => [
                ['name' => 'Rivera, Trisha Mae', 'college' => 'CTHM', 'percent' => 49],
                ['name' => 'Salazar, Mark Vincent', 'college' => 'CASL', 'percent' => 51],
            ],

            'Auditor' => [
                ['name' => 'Mercado, Justine Claire', 'college' => 'CIT', 'percent' => 57],
                ['name' => 'Francisco, Ella Grace', 'college' => 'CTE', 'percent' => 43],
            ],

            'Business Manager (1 of 2)' => [
                ['name' => 'Lim, Joshua Andrei', 'college' => 'CCS', 'percent' => 52],
                ['name' => 'Tan, Samantha Nicole', 'college' => 'CBPA', 'percent' => 48],
            ],

            'Business Manager (2 of 2)' => [
                ['name' => 'Ocampo, Vince Gabriel', 'college' => 'CIT', 'percent' => 44],
                ['name' => 'Sy, Camille Denise', 'college' => 'CTHM', 'percent' => 56],
            ],

            'Press Relations Officer (1 of 2)' => [
                ['name' => 'Del Rosario, Mikaela Jane', 'college' => 'CASL', 'percent' => 59],
                ['name' => 'Aguilar, Sean Patrick', 'college' => 'CCS', 'percent' => 41],
            ],

            'Press Relations Officer (2 of 2)' => [
                ['name' => 'Padilla, Krystal Anne', 'college' => 'CTE', 'percent' => 45],
                ['name' => 'Marquez, Benedict Paul', 'college' => 'CBPA', 'percent' => 55],
            ],

            'House Speaker' => [
                ['name' => 'Soriano, Gabriel James', 'college' => 'CASL', 'percent' => 50],
                ['name' => 'Velasco, Mia Therese', 'college' => 'CCS', 'percent' => 50],
            ],

            'Deputy House Speaker' => [
                ['name' => 'Alvarez, Cedrick John', 'college' => 'CIT', 'percent' => 48],
                ['name' => 'Luna, Princess Mae', 'college' => 'CTE', 'percent' => 52],
            ],

            'Legislative Secretary' => [
                ['name' => 'Pascual, Rhea Camille', 'college' => 'CBPA', 'percent' => 46],
                ['name' => 'Valdez, Nathaniel Cruz', 'college' => 'CTHM', 'percent' => 54],
            ],

            'Mayor’s League Chairperson' => [
                ['name' => 'Cabrera, Vincent Leo', 'college' => 'CCS', 'percent' => 53],
                ['name' => 'Ignacio, Clarisse Mae', 'college' => 'CASL', 'percent' => 47],
            ],

            'Mayor’s League Co-Chairperson' => [
                ['name' => 'Montemayor, Kevin John', 'college' => 'CBPA', 'percent' => 49],
                ['name' => 'Santiago, Bella Francesca', 'college' => 'CTE', 'percent' => 51],
            ],
        ];

        $collegeResults = [
            'CASL Governor' => [
                ['name' => 'Casal, Renee Anne', 'college' => 'CASL', 'percent' => 57],
                ['name' => 'Manalo, Arvin Jake', 'college' => 'CASL', 'percent' => 43],
            ],
            'CASL Vice Governor' => [
                ['name' => 'Belen, Camille Joy', 'college' => 'CASL', 'percent' => 52],
                ['name' => 'Serrano, Luis Miguel', 'college' => 'CASL', 'percent' => 48],
            ],
            'CBPA Governor' => [
                ['name' => 'Buenaventura, Carla Mae', 'college' => 'CBPA', 'percent' => 55],
                ['name' => 'Macaraeg, Jomar Luis', 'college' => 'CBPA', 'percent' => 45],
            ],
            'CBPA Vice Governor' => [
                ['name' => 'Galvez, Irene Faith', 'college' => 'CBPA', 'percent' => 51],
                ['name' => 'Abad, Patrick Ryan', 'college' => 'CBPA', 'percent' => 49],
            ],
            'CCS Governor' => [
                ['name' => 'Tolentino, Erika Mae', 'college' => 'CCS', 'percent' => 60],
                ['name' => 'De Vera, Aaron James', 'college' => 'CCS', 'percent' => 40],
            ],
            'CCS Vice Governor' => [
                ['name' => 'Mallari, Hazel Grace', 'college' => 'CCS', 'percent' => 54],
                ['name' => 'Corpuz, Jan Michael', 'college' => 'CCS', 'percent' => 46],
            ],
            'CIT Governor' => [
                ['name' => 'Pineda, Ralph Christian', 'college' => 'CIT', 'percent' => 49],
                ['name' => 'Natividad, Joyce Ann', 'college' => 'CIT', 'percent' => 51],
            ],
            'CIT Vice Governor' => [
                ['name' => 'Rosales, Kent Adrian', 'college' => 'CIT', 'percent' => 56],
                ['name' => 'Antonio, Loraine Mae', 'college' => 'CIT', 'percent' => 44],
            ],
            'CTE Governor' => [
                ['name' => 'Estrella, Marco Angelo', 'college' => 'CTE', 'percent' => 46],
                ['name' => 'Manzano, Claire Denise', 'college' => 'CTE', 'percent' => 54],
            ],
            'CTE Vice Governor' => [
                ['name' => 'Cabral, Josephine Mae', 'college' => 'CTE', 'percent' => 58],
                ['name' => 'David, Ron Gabriel', 'college' => 'CTE', 'percent' => 42],
            ],
            'CTHM Governor' => [
                ['name' => 'Samson, Alyssa Jane', 'college' => 'CTHM', 'percent' => 53],
                ['name' => 'Yap, Cedric Lance', 'college' => 'CTHM', 'percent' => 47],
            ],
            'CTHM Vice Governor' => [
                ['name' => 'Villamor, Angelica Rose', 'college' => 'CTHM', 'percent' => 50],
                ['name' => 'Chua, Francis Neil', 'college' => 'CTHM', 'percent' => 50],
            ],
        ];
    @endphp

    <div class="page active" id="page-transparency">
        <div class="page-hero">
            <h2>Transparency Dashboard</h2>
        </div>

        <div style="max-width:1100px;margin:0 auto;padding:1.5rem">

            <div class="row g-3 mb-4">
                @foreach ($stats as $stat)
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-num" style="color:{{ $stat['color'] }}">
                                {{ $stat['num'] }}
                            </div>

                            <div class="stat-label">
                                {{ $stat['label'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-3">
                @foreach ($results as $position => $candidates)
                    <div class="col-12 col-md-6">
                        <div class="ssc-card">
                            <div class="ssc-card-header">
                                <i class="bi bi-trophy-fill" style="color:var(--gold)"></i>
                                {{ strtoupper($position) }}
                            </div>

                            <div style="padding:1rem">
                                @foreach ($candidates as $candidate)
                                    <div class="result-row">
                                        <div class="d-flex justify-content-between align-items-center gap-2">
                                            <div style="font-size:.82rem">
                                                {{ $candidate['name'] }}
                                                <span class="college-badge">
                                                    {{ $candidate['college'] }}
                                                </span>
                                            </div>

                                            <span style="font-size:.78rem;color:var(--gold)">
                                                {{ $candidate['percent'] }}%
                                            </span>
                                        </div>

                                        <div class="result-bar-wrap">
                                            <div class="result-bar" style="width:{{ $candidate['percent'] }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-12">
                    <div class="ssc-card">
                        <div class="ssc-card-header">
                            <i class="bi bi-diagram-3-fill"></i>
                            COLLEGE GOVERNORS & VICE GOVERNORS — ALL COLLEGES
                        </div>

                        <div style="padding:1rem">
                            <div class="row g-3">
                                @foreach ($collegeResults as $position => $candidates)
                                    <div class="col-12 col-md-6">
                                        <div style="font-size:.75rem;color:var(--gold-light);margin-bottom:.5rem;font-family:'Cinzel',serif">
                                            {{ strtoupper($position) }}
                                        </div>

                                        @foreach ($candidates as $candidate)
                                            <div class="result-row">
                                                <div class="d-flex justify-content-between align-items-center gap-2">
                                                    <div style="font-size:.82rem">
                                                        {{ $candidate['name'] }}
                                                        <span class="college-badge">
                                                            {{ $candidate['college'] }}
                                                        </span>
                                                    </div>

                                                    <span style="font-size:.78rem;color:var(--gold)">
                                                        {{ $candidate['percent'] }}%
                                                    </span>
                                                </div>

                                                <div class="result-bar-wrap">
                                                    <div class="result-bar" style="width:{{ $candidate['percent'] }}%"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>