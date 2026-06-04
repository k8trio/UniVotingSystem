<x-layout :admin="true">
    <div class="page active" id="page-admin">
        <div class="d-flex">
            <div class="admin-sidebar">
                <div style="padding:.75rem 1.4rem .5rem;font-size:.62rem;color:var(--text-muted);letter-spacing:.1em;text-transform:uppercase">
                    Management
                </div>

                <a href="#dashboard" class="sidebar-item active" onclick="showAdminTab(event, 'dashboard')">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>

                <a href="#candidates" class="sidebar-item" onclick="showAdminTab(event, 'candidates')">
                    <i class="bi bi-person-badge"></i>
                    Candidates
                </a>

                <a href="#voters" class="sidebar-item" onclick="showAdminTab(event, 'voters')">
                    <i class="bi bi-people-fill"></i>
                    Voters
                </a>

                <a href="#results" class="sidebar-item" onclick="showAdminTab(event, 'results')">
                    <i class="bi bi-bar-chart-fill"></i>
                    Results
                </a>

                <div style="padding:.75rem 1.4rem .5rem;margin-top:.75rem;font-size:.62rem;color:var(--text-muted);letter-spacing:.1em;text-transform:uppercase;border-top:1px solid var(--border)">
                    System
                </div>

                <a href="#" class="sidebar-item" onclick="logoutUser()">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>
            </div>

            <div class="admin-content">

                {{-- DASHBOARD TAB --}}
                <div class="admin-tab active" id="admin-dashboard">
                    <div class="page-hero" style="margin:-1.5rem -1.5rem 1.5rem;text-align:left;padding:1.5rem">
                        <h2 style="font-size:1.1rem">
                            Admin Dashboard
                        </h2>

                        <p>
                            Welcome, Admin! · SSC Elections 2026
                        </p>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-num">
                                    {{ $totalVoters }}
                                </div>

                                <div class="stat-label">
                                    Registered Voters
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-num" style="color:#90ffcc">
                                    {{ $votesCast }}
                                </div>

                                <div class="stat-label">
                                    Votes Cast
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-num" style="color:var(--gold-light)">
                                    {{ $turnout }}%
                                </div>

                                <div class="stat-label">
                                    Turnout
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-num">
                                    {{ $totalCandidates }}
                                </div>

                                <div class="stat-label">
                                    Candidates
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ssc-card">
                        <div class="ssc-card-header">
                            <i class="bi bi-people-fill"></i>
                            Voters by College
                        </div>

                        <div style="padding:1rem">
                            @forelse ($collegeStats as $row)
                                <div class="result-row">
                                    <div class="d-flex justify-content-between">
                                        <span style="font-size:.82rem">
                                            {{ $row['college'] }}
                                        </span>

                                        <span style="font-size:.78rem;color:var(--gold)">
                                            {{ $row['votes'] }}/{{ $row['total'] }} ({{ $row['percent'] }}%)
                                        </span>
                                    </div>

                                    <div class="result-bar-wrap">
                                        <div class="result-bar" style="width:{{ $row['percent'] }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <div style="padding:1rem;color:var(--text-muted);font-size:.85rem;text-align:center">
                                    No registered voters yet.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- CANDIDATES TAB --}}
                <div class="admin-tab" id="admin-candidates">
                    <div class="page-hero" style="margin:-1.5rem -1.5rem 1.5rem;text-align:left;padding:1.5rem">
                        <h2 style="font-size:1.1rem">
                            Manage Candidates
                        </h2>

                        <p>
                            Add, edit, and remove candidates
                        </p>
                    </div>

                    <div class="ssc-card">
                        <div class="ssc-card-header">
                            <i class="bi bi-person-badge"></i>
                            Candidate List
                        </div>

                        <div style="overflow-x:auto">
                            <table class="table table-ssc">
                                <thead>
                                    <tr>
                                        <th>Position</th>
                                        <th>Name</th>
                                        <th>College</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($candidates as $candidate)
                                        <tr>
                                            <td>
                                                <span style="font-size:.72rem;color:var(--text-muted)">
                                                    {{ $candidate->position->name ?? 'No Position' }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $candidate->full_name }}
                                            </td>

                                            <td>
                                                <span class="college-badge">
                                                    {{ $candidate->college }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($candidate->is_active)
                                                    <span style="color:#90ffcc;font-size:.75rem">
                                                        Active
                                                    </span>
                                                @else
                                                    <span style="color:#ffaaaa;font-size:.75rem">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <button class="btn-outline-gold btn-sm-ssc me-1">
                                                    Edit
                                                </button>

                                                <button class="btn-danger-ssc">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;color:var(--text-muted);padding:1rem">
                                                No candidates found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- VOTERS TAB --}}
                <div class="admin-tab" id="admin-voters">
                    <div class="page-hero" style="margin:-1.5rem -1.5rem 1.5rem;text-align:left;padding:1.5rem">
                        <h2 style="font-size:1.1rem">
                            Registered Voters
                        </h2>

                        <p>
                            View and manage registered voters
                        </p>
                    </div>

                    <div class="ssc-card">
                        <div class="ssc-card-header">
                            <i class="bi bi-people-fill"></i>
                            Voter List
                        </div>

                        <div style="overflow-x:auto">
                            <table class="table table-ssc">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>College</th>
                                        <th>Year &amp; Section</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($voters as $voter)
                                        <tr>
                                            <td>
                                                {{ $voter->student_id }}
                                            </td>

                                            <td>
                                                {{ $voter->last_name }}, {{ $voter->first_name }}
                                            </td>

                                            <td>
                                                <span class="college-badge">
                                                    {{ $voter->college }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $voter->year_and_section }}
                                            </td>

                                            <td>
                                                @if ($voter->has_voted)
                                                    <span style="color:#90ffcc;font-size:.75rem">
                                                        Voted
                                                    </span>
                                                @else
                                                    <span style="color:#ffaaaa;font-size:.75rem">
                                                        Not Yet
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;color:var(--text-muted);padding:1rem">
                                                No voters found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- RESULTS TAB --}}
                <div class="admin-tab" id="admin-results">
                    <div class="page-hero" style="margin:-1.5rem -1.5rem 1.5rem;text-align:left;padding:1.5rem">
                        <h2 style="font-size:1.1rem">
                            Election Results
                        </h2>

                        <p>
                            Real-time vote tallying across all positions
                        </p>
                    </div>

                    <div class="row g-3">
                        @forelse ($positions as $position)
                            @php
                                $positionTotal = $position->candidates->sum(function ($candidate) use ($voteCounts) {
                                    return $voteCounts[$candidate->id] ?? 0;
                                });
                            @endphp

                            <div class="col-12 col-md-6">
                                <div class="ssc-card">
                                    <div class="ssc-card-header" style="font-size:.72rem">
                                        {{ strtoupper($position->name) }}
                                    </div>

                                    <div style="padding:.85rem">
                                        @forelse ($position->candidates as $candidate)
                                            @php
                                                $candidateVotes = $voteCounts[$candidate->id] ?? 0;

                                                $percent = $positionTotal > 0
                                                    ? round(($candidateVotes / $positionTotal) * 100)
                                                    : 0;
                                            @endphp

                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <div style="width:130px;font-size:.75rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                    {{ $candidate->full_name }}
                                                </div>

                                                <div class="result-bar-wrap flex-grow-1">
                                                    <div class="result-bar" style="width:{{ $percent }}%"></div>
                                                </div>

                                                <div style="width:36px;text-align:right;font-size:.75rem;color:var(--gold)">
                                                    {{ $percent }}%
                                                </div>
                                            </div>
                                        @empty
                                            <div style="padding:.75rem;color:var(--text-muted);font-size:.8rem;text-align:center">
                                                No candidates for this position.
                                            </div>
                                        @endforelse

                                        <div style="margin-top:.75rem;font-size:.72rem;color:var(--text-muted);text-align:right">
                                            Total votes: {{ $positionTotal }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="ssc-card" style="padding:1rem;text-align:center;color:var(--text-muted)">
                                    No election results available.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>