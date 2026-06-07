<x-layout>
    <div class="page active" id="page-ballot">
        <div class="ballot-outer">
            <div class="blur-frame blur-frame-left"></div>
            <div class="blur-frame blur-frame-right"></div>

            <div class="ballot-content">

                <div class="text-center mb-3 pt-2">
                    <h2 style="font-size:1.3rem;color:var(--gold-light)">
                        Official Ballot
                    </h2>

                    <div style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">
                        {{ $user->student_id }} —
                        {{ $user->last_name }}, {{ $user->first_name }}
                        | {{ $user->college }}
                        | {{ $user->year_and_section }}
                    </div>
                </div>

                <div class="ssc-card mb-3">
                    <div style="padding:.75rem 1rem">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span style="font-size:.72rem;color:var(--text-muted);letter-spacing:.06em;text-transform:uppercase">
                                Voting Progress
                            </span>

                            <span id="progressText" style="font-size:.8rem;color:var(--gold);font-family:'Cinzel',serif">
                                0 / 0
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

                    @foreach ($executivePositions as $position)
                        <div
                            class="position-section mb-3"
                            data-vote-position="{{ $position->id }}"
                            data-position-name="{{ $position->name }}"
                            data-max-winners="{{ $position->max_winners }}"
                        >
                            <div class="position-label">
                                {{ $position->name }}

                                @if ($position->max_winners > 1)
                                    <span style="font-size:.65rem;color:var(--text-muted)">
                                        Choose {{ $position->max_winners }}
                                    </span>
                                @endif

                                <span class="dept-badge dept-exec">
                                    EXECUTIVE
                                </span>
                            </div>

                            <div class="row g-2">
                                @foreach ($position->candidates as $candidate)
                                    <div class="col-6 col-md-4">
                                        <div
                                            class="candidate-card"
                                            onclick="selectCandidate(this)"
                                            data-candidate-id="{{ $candidate->id }}"
                                            data-candidate-name="{{ $candidate->full_name }}"
                                            data-candidate-college="{{ $candidate->college }}"
                                        >
                                            <div class="candidate-avatar">
                                                {{ $candidate->initials }}
                                            </div>

                                            <div class="candidate-name">
                                                {{ $candidate->full_name }}
                                            </div>

                                            <div class="candidate-college">
                                                {{ $candidate->college }}
                                            </div>

                                            @if ($candidate->partylist)
                                                <div class="candidate-college">
                                                    {{ $candidate->partylist }}
                                                </div>
                                            @endif
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

                    @foreach ($legislativePositions as $position)
                        <div
                            class="position-section mb-3"
                            data-vote-position="{{ $position->id }}"
                            data-position-name="{{ $position->name }}"
                            data-max-winners="{{ $position->max_winners }}"
                        >
                            <div class="position-label">
                                {{ $position->name }}

                                @if ($position->max_winners > 1)
                                    <span style="font-size:.65rem;color:var(--text-muted)">
                                        Choose {{ $position->max_winners }}
                                    </span>
                                @endif

                                <span class="dept-badge dept-legis">
                                    LEGISLATIVE
                                </span>
                            </div>

                            <div class="row g-2">
                                @foreach ($position->candidates as $candidate)
                                    <div class="col-6 col-md-4">
                                        <div
                                            class="candidate-card"
                                            onclick="selectCandidate(this)"
                                            data-candidate-id="{{ $candidate->id }}"
                                            data-candidate-name="{{ $candidate->full_name }}"
                                            data-candidate-college="{{ $candidate->college }}"
                                        >
                                            <div class="candidate-avatar">
                                                {{ $candidate->initials }}
                                            </div>

                                            <div class="candidate-name">
                                                {{ $candidate->full_name }}
                                            </div>

                                            <div class="candidate-college">
                                                {{ $candidate->college }}
                                            </div>

                                            @if ($candidate->partylist)
                                                <div class="candidate-college">
                                                    {{ $candidate->partylist }}
                                                </div>
                                            @endif
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
