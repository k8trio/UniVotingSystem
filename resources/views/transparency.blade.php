<x-layout>
    <div class="page active" id="page-transparency">
        <div class="container py-5">

            <div class="text-center mb-4">
                <h2 style="color:var(--gold-light)">
                    Transparency Dashboard
                </h2>

                <p style="color:var(--text-muted);font-size:.9rem">
                    Live vote summary based on submitted ballots.
                </p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="ssc-card text-center p-4">
                        <div style="font-size:1.8rem;color:var(--gold);font-family:'Cinzel',serif">
                            {{ $totalVoters }}
                        </div>
                        <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.08em">
                            Registered Voters
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="ssc-card text-center p-4">
                        <div style="font-size:1.8rem;color:var(--gold);font-family:'Cinzel',serif">
                            {{ $votedCount }}
                        </div>
                        <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.08em">
                            Voters Submitted
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="ssc-card text-center p-4">
                        <div style="font-size:1.8rem;color:var(--gold);font-family:'Cinzel',serif">
                            {{ $totalVotes }}
                        </div>
                        <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.08em">
                            Total Vote Entries
                        </div>
                    </div>
                </div>
            </div>

            <div class="ssc-card">
                <div class="ssc-card-header">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    Election Results
                </div>

                <div class="p-3">
                    @foreach ($positions as $position)
                        @php
                            $positionTotal = $position->candidates->sum(function ($candidate) use ($voteCounts) {
                                return $voteCounts[$candidate->id] ?? 0;
                            });
                        @endphp

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <div style="color:var(--gold-light);font-weight:700">
                                        {{ $position->name }}
                                    </div>

                                    <div style="font-size:.75rem;color:var(--text-muted)">
                                        {{ strtoupper($position->department) }}
                                        @if ($position->college)
                                            • {{ $position->college }}
                                        @endif
                                    </div>
                                </div>

                                <span class="college-badge">
                                    {{ $positionTotal }} votes
                                </span>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-ssc align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Candidate</th>
                                            <th>College</th>
                                            <th style="width:120px">Votes</th>
                                            <th style="width:220px">Progress</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($position->candidates as $candidate)
                                            @php
                                                $candidateVotes = $voteCounts[$candidate->id] ?? 0;
                                                $percent = $positionTotal > 0
                                                    ? round(($candidateVotes / $positionTotal) * 100)
                                                    : 0;
                                            @endphp

                                            <tr>
                                                <td>
                                                    <strong>
                                                        {{ $candidate->full_name }}
                                                    </strong>

                                                    @if ($candidate->partylist)
                                                        <div style="font-size:.75rem;color:var(--text-muted)">
                                                            {{ $candidate->partylist }}
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <span class="college-badge">
                                                        {{ $candidate->college }}
                                                    </span>
                                                </td>

                                                <td>
                                                    {{ $candidateVotes }}
                                                </td>

                                                <td>
                                                    <div style="background:rgba(255,255,255,.08);border-radius:6px;height:8px;overflow:hidden">
                                                        <div style="height:100%;width:{{ $percent }}%;background:linear-gradient(90deg,var(--crimson),var(--gold));border-radius:6px"></div>
                                                    </div>

                                                    <div style="font-size:.7rem;color:var(--text-muted);margin-top:.2rem">
                                                        {{ $percent }}%
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center" style="color:var(--text-muted)">
                                                    No candidates available.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-layout>
