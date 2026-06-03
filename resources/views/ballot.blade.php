<x-layout>
    @php
        /*
            DEMO ONLY:
            Kapag may database/auth na tayo, ito papalitan ng logged-in user's college.
            Example:
            $voterCollege = auth()->user()->college;
        */
        $voterCollege = 'CCS';

        function initials($name) {
            $parts = explode(' ', str_replace(',', '', $name));
            $initials = '';

            foreach ($parts as $part) {
                if ($part !== '') {
                    $initials .= strtoupper(substr($part, 0, 1));
                }
            }

            return substr($initials, 0, 2);
        }

        $executivePositions = [
            'President' => [
                ['name' => 'Santos, Maria Angela', 'college' => 'CASL'],
                ['name' => 'Reyes, Carlo Miguel', 'college' => 'CBPA'],
                ['name' => 'Dela Cruz, Juan Paolo', 'college' => 'CCS'],
            ],

            'Executive Vice President' => [
                ['name' => 'Garcia, Sofia Mae', 'college' => 'CTE'],
                ['name' => 'Mendoza, Adrian James', 'college' => 'CIT'],
                ['name' => 'Bautista, Nicole Anne', 'college' => 'CTHM'],
            ],

            'Vice President for Students’ Right and Welfare' => [
                ['name' => 'Torres, Hannah Claire', 'college' => 'CASL'],
                ['name' => 'Ramos, Christian Dale', 'college' => 'CCS'],
            ],

            'Vice President for Projects and Activities' => [
                ['name' => 'Flores, Erika Louise', 'college' => 'CBPA'],
                ['name' => 'Castillo, John Mark', 'college' => 'CIT'],
            ],

            'Vice President for Communications' => [
                ['name' => 'Aquino, Patricia Joy', 'college' => 'CTE'],
                ['name' => 'Navarro, Kyle Matthew', 'college' => 'CCS'],
            ],

            'Vice President for Marketing and Creatives' => [
                ['name' => 'Villanueva, Andrea Faith', 'college' => 'CTHM'],
                ['name' => 'Lopez, Daniel Angelo', 'college' => 'CASL'],
            ],

            'Executive Secretary' => [
                ['name' => 'Fernandez, Alyssa Marie', 'college' => 'CCS'],
                ['name' => 'Cruz, Rafael Luis', 'college' => 'CBPA'],
            ],

            'Deputy Secretary' => [
                ['name' => 'Morales, Janelle Rose', 'college' => 'CTE'],
                ['name' => 'Perez, Miguel Antonio', 'college' => 'CIT'],
            ],

            'Treasurer' => [
                ['name' => 'Domingo, Carla Beatrice', 'college' => 'CBPA'],
                ['name' => 'Gonzales, Ivan Joseph', 'college' => 'CCS'],
            ],

            'Sub-Treasurer' => [
                ['name' => 'Rivera, Trisha Mae', 'college' => 'CTHM'],
                ['name' => 'Salazar, Mark Vincent', 'college' => 'CASL'],
            ],

            'Auditor' => [
                ['name' => 'Mercado, Justine Claire', 'college' => 'CIT'],
                ['name' => 'Francisco, Ella Grace', 'college' => 'CTE'],
            ],

            'Business Manager (1 of 2)' => [
                ['name' => 'Lim, Joshua Andrei', 'college' => 'CCS'],
                ['name' => 'Tan, Samantha Nicole', 'college' => 'CBPA'],
            ],

            'Business Manager (2 of 2)' => [
                ['name' => 'Ocampo, Vince Gabriel', 'college' => 'CIT'],
                ['name' => 'Sy, Camille Denise', 'college' => 'CTHM'],
            ],

            'Press Relations Officer (1 of 2)' => [
                ['name' => 'Del Rosario, Mikaela Jane', 'college' => 'CASL'],
                ['name' => 'Aguilar, Sean Patrick', 'college' => 'CCS'],
            ],

            'Press Relations Officer (2 of 2)' => [
                ['name' => 'Padilla, Krystal Anne', 'college' => 'CTE'],
                ['name' => 'Marquez, Benedict Paul', 'college' => 'CBPA'],
            ],
        ];

        $legislativeGeneral = [
            'House Speaker' => [
                ['name' => 'Soriano, Gabriel James', 'college' => 'CASL'],
                ['name' => 'Velasco, Mia Therese', 'college' => 'CCS'],
            ],

            'Deputy House Speaker' => [
                ['name' => 'Alvarez, Cedrick John', 'college' => 'CIT'],
                ['name' => 'Luna, Princess Mae', 'college' => 'CTE'],
            ],

            'Legislative Secretary' => [
                ['name' => 'Pascual, Rhea Camille', 'college' => 'CBPA'],
                ['name' => 'Valdez, Nathaniel Cruz', 'college' => 'CTHM'],
            ],
        ];

        $collegePositions = [
            'CASL' => [
                'CASL Governor' => [
                    ['name' => 'Casal, Renee Anne', 'college' => 'CASL'],
                    ['name' => 'Manalo, Arvin Jake', 'college' => 'CASL'],
                ],
                'CASL Vice Governor' => [
                    ['name' => 'Belen, Camille Joy', 'college' => 'CASL'],
                    ['name' => 'Serrano, Luis Miguel', 'college' => 'CASL'],
                ],
            ],

            'CBPA' => [
                'CBPA Governor' => [
                    ['name' => 'Buenaventura, Carla Mae', 'college' => 'CBPA'],
                    ['name' => 'Macaraeg, Jomar Luis', 'college' => 'CBPA'],
                ],
                'CBPA Vice Governor' => [
                    ['name' => 'Galvez, Irene Faith', 'college' => 'CBPA'],
                    ['name' => 'Abad, Patrick Ryan', 'college' => 'CBPA'],
                ],
            ],

            'CCS' => [
                'CCS Governor' => [
                    ['name' => 'Tolentino, Erika Mae', 'college' => 'CCS'],
                    ['name' => 'De Vera, Aaron James', 'college' => 'CCS'],
                ],
                'CCS Vice Governor' => [
                    ['name' => 'Mallari, Hazel Grace', 'college' => 'CCS'],
                    ['name' => 'Corpuz, Jan Michael', 'college' => 'CCS'],
                ],
            ],

            'CIT' => [
                'CIT Governor' => [
                    ['name' => 'Pineda, Ralph Christian', 'college' => 'CIT'],
                    ['name' => 'Natividad, Joyce Ann', 'college' => 'CIT'],
                ],
                'CIT Vice Governor' => [
                    ['name' => 'Rosales, Kent Adrian', 'college' => 'CIT'],
                    ['name' => 'Antonio, Loraine Mae', 'college' => 'CIT'],
                ],
            ],

            'CTE' => [
                'CTE Governor' => [
                    ['name' => 'Estrella, Marco Angelo', 'college' => 'CTE'],
                    ['name' => 'Manzano, Claire Denise', 'college' => 'CTE'],
                ],
                'CTE Vice Governor' => [
                    ['name' => 'Cabral, Josephine Mae', 'college' => 'CTE'],
                    ['name' => 'David, Ron Gabriel', 'college' => 'CTE'],
                ],
            ],

            'CTHM' => [
                'CTHM Governor' => [
                    ['name' => 'Samson, Alyssa Jane', 'college' => 'CTHM'],
                    ['name' => 'Yap, Cedric Lance', 'college' => 'CTHM'],
                ],
                'CTHM Vice Governor' => [
                    ['name' => 'Villamor, Angelica Rose', 'college' => 'CTHM'],
                    ['name' => 'Chua, Francis Neil', 'college' => 'CTHM'],
                ],
            ],
        ];

        $mayorsLeague = [
            'Mayor’s League Chairperson' => [
                ['name' => 'Cabrera, Vincent Leo', 'college' => 'CCS'],
                ['name' => 'Ignacio, Clarisse Mae', 'college' => 'CASL'],
            ],

            'Mayor’s League Co-Chairperson' => [
                ['name' => 'Montemayor, Kevin John', 'college' => 'CBPA'],
                ['name' => 'Santiago, Bella Francesca', 'college' => 'CTE'],
            ],
        ];
    @endphp

    <div class="page active" id="page-ballot">
        <div class="ballot-outer">
            <div class="blur-frame blur-frame-left"></div>
            <div class="blur-frame blur-frame-right"></div>

            <div class="ballot-content">

                <div class="text-center mb-3 pt-2">
                    <div class="cinzel" style="font-size:.68rem;color:var(--text-muted);letter-spacing:.1em;text-transform:uppercase">
                        Supreme Student Council Elections 2026
                    </div>

                    <h2 style="font-size:1.3rem;color:var(--gold-light)">
                        Official Ballot
                    </h2>

                    <div id="ballotVoterInfo" style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">
                        23-LN-0008 — Inoue, Kate Diane | {{ $voterCollege }} | III-BSIT-B
                    </div>
                </div>

                <div class="ssc-card mb-3">
                    <div style="padding:.75rem 1rem">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span style="font-size:.72rem;color:var(--text-muted);letter-spacing:.06em;text-transform:uppercase">
                                Voting Progress
                            </span>

                            <span id="progressText" style="font-size:.8rem;color:var(--gold);font-family:'Cinzel',serif">
                                0 / 22
                            </span>
                        </div>

                        <div style="background:rgba(255,255,255,.08);border-radius:6px;height:8px;overflow:hidden">
                            <div id="progressBar" style="height:100%;background:linear-gradient(90deg,var(--crimson),var(--gold));width:0%;transition:width .4s;border-radius:6px"></div>
                        </div>
                    </div>
                </div>

                <div class="position-section">
                    <div class="ssc-card-header" style="background:linear-gradient(90deg,#3a0000,#6a0000);font-size:.85rem;padding:.85rem 1.2rem;border-radius:8px 8px 0 0;margin-bottom:.5rem">
                        <i class="bi bi-star-fill" style="color:var(--gold)"></i>
                        EXECUTIVE DEPARTMENT
                    </div>

                    @foreach ($executivePositions as $position => $candidates)
                        <div class="position-section mb-2" data-vote-position="{{ $position }}">
                            <div class="position-label">
                                {{ $position }}
                                <span class="dept-badge dept-exec">EXECUTIVE</span>
                            </div>

                            <div class="row g-2">
                                @foreach ($candidates as $candidate)
                                    <div class="col-6 col-md-4">
                                        <div class="candidate-card"
                                             onclick="selectCandidate(this)"
                                             data-candidate-name="{{ $candidate['name'] }}"
                                             data-candidate-college="{{ $candidate['college'] }}">

                                            <div class="candidate-avatar">
                                                {{ initials($candidate['name']) }}
                                            </div>

                                            <div class="candidate-name">
                                                {{ $candidate['name'] }}
                                            </div>

                                            <div class="candidate-college">
                                                {{ $candidate['college'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="gold-divider"></div>

                <div class="position-section">
                    <div class="ssc-card-header" style="background:linear-gradient(90deg,#1a1200,#3a2800);font-size:.85rem;padding:.85rem 1.2rem;border-radius:8px 8px 0 0;margin-bottom:.5rem">
                        <i class="bi bi-building" style="color:var(--gold)"></i>
                        LEGISLATIVE DEPARTMENT
                    </div>

                    @foreach ($legislativeGeneral as $position => $candidates)
                        <div class="position-section mb-2" data-vote-position="{{ $position }}">
                            <div class="position-label">
                                {{ $position }}
                                <span class="dept-badge dept-legis">LEGISLATIVE</span>
                            </div>

                            <div class="row g-2">
                                @foreach ($candidates as $candidate)
                                    <div class="col-6 col-md-4">
                                        <div class="candidate-card"
                                             onclick="selectCandidate(this)"
                                             data-candidate-name="{{ $candidate['name'] }}"
                                             data-candidate-college="{{ $candidate['college'] }}">

                                            <div class="candidate-avatar">
                                                {{ initials($candidate['name']) }}
                                            </div>

                                            <div class="candidate-name">
                                                {{ $candidate['name'] }}
                                            </div>

                                            <div class="candidate-college">
                                                {{ $candidate['college'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @foreach ($collegePositions[$voterCollege] as $position => $candidates)
                        <div class="position-section mb-2" data-vote-position="{{ $position }}">
                            <div class="position-label">
                                {{ $position }}
                                <span class="dept-badge dept-legis">LEGISLATIVE</span>
                            </div>

                            <div class="row g-2">
                                @foreach ($candidates as $candidate)
                                    <div class="col-6 col-md-4">
                                        <div class="candidate-card"
                                             onclick="selectCandidate(this)"
                                             data-candidate-name="{{ $candidate['name'] }}"
                                             data-candidate-college="{{ $candidate['college'] }}">

                                            <div class="candidate-avatar">
                                                {{ initials($candidate['name']) }}
                                            </div>

                                            <div class="candidate-name">
                                                {{ $candidate['name'] }}
                                            </div>

                                            <div class="candidate-college">
                                                {{ $candidate['college'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @foreach ($mayorsLeague as $position => $candidates)
                        <div class="position-section mb-2" data-vote-position="{{ $position }}">
                            <div class="position-label">
                                {{ $position }}
                                <span class="dept-badge dept-legis">LEGISLATIVE</span>
                            </div>

                            <div class="row g-2">
                                @foreach ($candidates as $candidate)
                                    <div class="col-6 col-md-4">
                                        <div class="candidate-card"
                                             onclick="selectCandidate(this)"
                                             data-candidate-name="{{ $candidate['name'] }}"
                                             data-candidate-college="{{ $candidate['college'] }}">

                                            <div class="candidate-avatar">
                                                {{ initials($candidate['name']) }}
                                            </div>

                                            <div class="candidate-name">
                                                {{ $candidate['name'] }}
                                            </div>

                                            <div class="candidate-college">
                                                {{ $candidate['college'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4 mb-5">
                    <a href="/review" class="btn-gold" style="padding:.9rem 2.5rem;font-size:.9rem">
                        <i class="bi bi-check2-circle me-2"></i>
                        REVIEW &amp; SUBMIT VOTE
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>