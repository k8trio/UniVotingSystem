<x-layout :admin="true">
    @php
        $collegeStats = [
            ['college' => 'CASL', 'votes' => 180, 'total' => 260, 'percent' => 69],
            ['college' => 'CBPA', 'votes' => 205, 'total' => 310, 'percent' => 66],
            ['college' => 'CCS', 'votes' => 238, 'total' => 340, 'percent' => 70],
            ['college' => 'CIT', 'votes' => 190, 'total' => 295, 'percent' => 64],
            ['college' => 'CTE', 'votes' => 210, 'total' => 330, 'percent' => 64],
            ['college' => 'CTHM', 'votes' => 180, 'total' => 312, 'percent' => 58],
        ];

        $candidates = [
            ['position' => 'President', 'name' => 'Santos, Maria Angela', 'college' => 'CASL'],
            ['position' => 'Executive Vice President', 'name' => 'Reyes, Carlo Miguel', 'college' => 'CBPA'],
            ['position' => 'Treasurer', 'name' => 'Gonzales, Ivan Joseph', 'college' => 'CCS'],
            ['position' => 'House Speaker', 'name' => 'Soriano, Gabriel James', 'college' => 'CASL'],
            ['position' => 'CCS Governor', 'name' => 'Tolentino, Erika Mae', 'college' => 'CCS'],
            ['position' => 'CTE Governor', 'name' => 'Manzano, Claire Denise', 'college' => 'CTE'],
        ];

        $voters = [
            ['id' => '23-LN-0001', 'name' => 'Dela Cruz, Juan', 'college' => 'CCS', 'year' => '3-BSIT-A', 'status' => 'Not Yet'],
            ['id' => '23-LN-0002', 'name' => 'Santos, Maria', 'college' => 'CASL', 'year' => '2-BAELS-B', 'status' => 'Not Yet'],
            ['id' => '23-LN-0003', 'name' => 'Reyes, Carlo', 'college' => 'CBPA', 'year' => '4-BSBA-A', 'status' => 'Voted'],
            ['id' => '23-LN-0004', 'name' => 'Garcia, Nina', 'college' => 'CTE', 'year' => '3-BSED-C', 'status' => 'Not Yet'],
            ['id' => '23-LN-0005', 'name' => 'Mendoza, Adrian', 'college' => 'CIT', 'year' => '3-BSITech-A', 'status' => 'Voted'],
        ];

        $results = [
            ['position' => 'President', 'candidate1' => 'Santos, Maria Angela', 'percent1' => 58, 'candidate2' => 'Reyes, Carlo Miguel', 'percent2' => 42],
            ['position' => 'Executive Vice President', 'candidate1' => 'Garcia, Sofia Mae', 'percent1' => 51, 'candidate2' => 'Mendoza, Adrian James', 'percent2' => 49],
            ['position' => 'House Speaker', 'candidate1' => 'Soriano, Gabriel James', 'percent1' => 62, 'candidate2' => 'Velasco, Mia Therese', 'percent2' => 38],
            ['position' => 'Treasurer', 'candidate1' => 'Domingo, Carla Beatrice', 'percent1' => 55, 'candidate2' => 'Gonzales, Ivan Joseph', 'percent2' => 45],
        ];
    @endphp

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
                                    1,847
                                </div>

                                <div class="stat-label">
                                    Registered Voters
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-num" style="color:#90ffcc">
                                    1,203
                                </div>

                                <div class="stat-label">
                                    Votes Cast
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-num" style="color:var(--gold-light)">
                                    65.1%
                                </div>

                                <div class="stat-label">
                                    Turnout
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-num">
                                    42
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
                            @foreach ($collegeStats as $row)
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
                            @endforeach
                        </div>
                    </div>
                </div>

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
                                    @foreach ($candidates as $candidate)
                                        <tr>
                                            <td>
                                                <span style="font-size:.72rem;color:var(--text-muted)">
                                                    {{ $candidate['position'] }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $candidate['name'] }}
                                            </td>

                                            <td>
                                                <span class="college-badge">
                                                    {{ $candidate['college'] }}
                                                </span>
                                            </td>

                                            <td>
                                                <span style="color:#90ffcc;font-size:.75rem">
                                                    Active
                                                </span>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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
                                    @foreach ($voters as $voter)
                                        <tr>
                                            <td>
                                                {{ $voter['id'] }}
                                            </td>

                                            <td>
                                                {{ $voter['name'] }}
                                            </td>

                                            <td>
                                                <span class="college-badge">
                                                    {{ $voter['college'] }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $voter['year'] }}
                                            </td>

                                            <td>
                                                @if ($voter['id'] === '23-LN-0008')
                                                    <span id="demoVoterStatus">
                                                        <span style="color:#ffaaaa;font-size:.75rem">
                                                            Not Yet
                                                        </span>
                                                    </span>
                                                @else
                                                    @if ($voter['status'] === 'Voted')
                                                        <span style="color:#90ffcc;font-size:.75rem">
                                                            Voted
                                                        </span>
                                                    @else
                                                        <span style="color:#ffaaaa;font-size:.75rem">
                                                            Not Yet
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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
                        @foreach ($results as $result)
                            <div class="col-12 col-md-6">
                                <div class="ssc-card">
                                    <div class="ssc-card-header" style="font-size:.72rem">
                                        {{ strtoupper($result['position']) }}
                                    </div>

                                    <div style="padding:.85rem">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <div style="width:130px;font-size:.75rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                {{ $result['candidate1'] }}
                                            </div>

                                            <div class="result-bar-wrap flex-grow-1">
                                                <div class="result-bar" style="width:{{ $result['percent1'] }}%"></div>
                                            </div>

                                            <div style="width:36px;text-align:right;font-size:.75rem;color:var(--gold)">
                                                {{ $result['percent1'] }}%
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <div style="width:130px;font-size:.75rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                {{ $result['candidate2'] }}
                                            </div>

                                            <div class="result-bar-wrap flex-grow-1">
                                                <div class="result-bar" style="width:{{ $result['percent2'] }}%"></div>
                                            </div>

                                            <div style="width:36px;text-align:right;font-size:.75rem;color:var(--gold)">
                                                {{ $result['percent2'] }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>