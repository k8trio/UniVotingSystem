<x-layout :admin="true">
    <div class="page active" id="page-admin">
        <div class="d-flex admin-shell">

            <aside class="admin-sidebar">
                <div class="sidebar-title">
                    <i class="bi bi-shield-lock-fill"></i>
                    ADMIN PANEL
                </div>

                <a href="/admin" class="sidebar-item active">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>

                <a href="/transparency" class="sidebar-item">
                    <i class="bi bi-bar-chart-fill"></i>
                    Transparency
                </a>

                <a href="#" class="sidebar-item" onclick="logoutUser()">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>
            </aside>

            <main class="admin-content">
                <div class="admin-top mb-4">
                    <div>
                        <h2 class="mb-1" style="color:var(--gold-light)">
                            Election Admin Dashboard
                        </h2>

                        <p class="mb-0" style="color:var(--text-muted);font-size:.9rem">
                            Manage and monitor the SSC election results.
                        </p>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="ssc-card text-center p-4">
                            <div class="admin-stat-number">
                                {{ $totalVoters }}
                            </div>
                            <div class="admin-stat-label">
                                Registered Voters
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="ssc-card text-center p-4">
                            <div class="admin-stat-number">
                                {{ $votedCount }}
                            </div>
                            <div class="admin-stat-label">
                                Voted
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="ssc-card text-center p-4">
                            <div class="admin-stat-number">
                                {{ $notVotedCount }}
                            </div>
                            <div class="admin-stat-label">
                                Not Yet Voted
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="ssc-card text-center p-4">
                            <div class="admin-stat-number">
                                {{ $totalCandidates }}
                            </div>
                            <div class="admin-stat-label">
                                Candidates
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ssc-card">
                    <div class="ssc-card-header">
                        <i class="bi bi-trophy-fill me-2"></i>
                        Candidate Vote Summary
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
                                                <th>Votes</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($position->candidates as $candidate)
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
                                                        {{ $voteCounts[$candidate->id] ?? 0 }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </main>

        </div>
    </div>
</x-layout>