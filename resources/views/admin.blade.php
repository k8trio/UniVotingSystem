<x-layout :admin="true">
    <div class="page active" id="page-admin">
        <div class="admin-mobile-nav">
    <a href="#dashboard" class="admin-mobile-nav-item active" onclick="showAdminTab(event, 'dashboard')">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>
    <a href="#candidates" class="admin-mobile-nav-item" onclick="showAdminTab(event, 'candidates')">
        <i class="bi bi-person-badge"></i>
        Candidates
    </a>
    <a href="#voters" class="admin-mobile-nav-item" onclick="showAdminTab(event, 'voters')">
        <i class="bi bi-people-fill"></i>
        Voters
    </a>
    <a href="#results" class="admin-mobile-nav-item" onclick="showAdminTab(event, 'results')">
        <i class="bi bi-bar-chart-fill"></i>
        Results
    </a>
    <a href="#" class="admin-mobile-nav-item" onclick="logoutUser()">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </a>
</div>
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
                    <div class="page-hero admin-dashboard-hero">
                        <h2 style="font-size:1.1rem">
                            Welcome, Admin! · SSC Elections 2026
                        </h2>

                        <div id="exportMessage" class="mt-3"></div>

                        <div class="admin-export-actions">

                            {{-- VOTERS EXPORT --}}
                            <div class="dropdown export-dropdown-box">
                                <button
                                    class="btn-outline-gold btn-sm-ssc dropdown-toggle export-main-btn"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-download me-1"></i>
                                    Export Voters
                                </button>

                                <ul class="dropdown-menu export-dropdown-menu">
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.voters', ['format' => 'pdf']) }}', 'voters_report.pdf')">PDF</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.voters', ['format' => 'xlsx']) }}', 'voters_report.xlsx')">XLSX</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.voters', ['format' => 'csv']) }}', 'voters_report.csv')">CSV</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.voters', ['format' => 'json']) }}', 'voters_report.json')">JSON</button></li>
                                </ul>
                            </div>

                            {{-- CANDIDATES EXPORT --}}
                            <div class="dropdown export-dropdown-box">
                                <button
                                    class="btn-outline-gold btn-sm-ssc dropdown-toggle export-main-btn"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-download me-1"></i>
                                    Export Candidates
                                </button>

                                <ul class="dropdown-menu export-dropdown-menu">
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.candidates', ['format' => 'pdf']) }}', 'candidates_report.pdf')">PDF</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.candidates', ['format' => 'xlsx']) }}', 'candidates_report.xlsx')">XLSX</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.candidates', ['format' => 'csv']) }}', 'candidates_report.csv')">CSV</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.candidates', ['format' => 'json']) }}', 'candidates_report.json')">JSON</button></li>
                                </ul>
                            </div>

                            {{-- RESULTS EXPORT --}}
                            <div class="dropdown export-dropdown-box">
                                <button
                                    class="btn-outline-gold btn-sm-ssc dropdown-toggle export-main-btn"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-download me-1"></i>
                                    Export Results
                                </button>

                                <ul class="dropdown-menu export-dropdown-menu">
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.results', ['format' => 'pdf']) }}', 'results_report.pdf')">PDF</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.results', ['format' => 'xlsx']) }}', 'results_report.xlsx')">XLSX</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.results', ['format' => 'csv']) }}', 'results_report.csv')">CSV</button></li>
                                    <li><button type="button" class="dropdown-item export-dropdown-item" onclick="downloadReport('{{ route('admin.export.results', ['format' => 'json']) }}', 'results_report.json')">JSON</button></li>
                                </ul>
                            </div>
                         </div>
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
                                <div class="stat-num">
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

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Please check the candidate form fields.
                        </div>
                    @endif

                    <div class="ssc-card mb-4">
                        <div class="ssc-card-header">
                            <i class="bi bi-person-plus-fill"></i>
                            Add New Candidate
                        </div>

                        <div style="padding:1rem">
                            <form action="{{ route('admin.candidates.store') }}" method="POST">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Position</label>
                                        <select name="position_id" class="form-select" required>
                                            <option value="">Select position</option>

                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}">
                                                    {{ $position->name }}
                                                    @if ($position->college)
                                                        — {{ $position->college }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">College</label>
                                        <select name="college" class="form-select" required>
                                            <option value="">Select college</option>
                                            <option value="CASL">CASL</option>
                                            <option value="CBPA">CBPA</option>
                                            <option value="CCS">CCS</option>
                                            <option value="CIT">CIT</option>
                                            <option value="CTE">CTE</option>
                                            <option value="CTHM">CTHM</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Partylist</label>
                                        <input type="text" name="partylist" class="form-control" placeholder="Optional">
                                    </div>

                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn-gold w-100">
                                            <i class="bi bi-plus-circle me-1"></i>
                                            Add Candidate
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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

                                                @if ($candidate->partylist)
                                                    <div style="font-size:.72rem;color:var(--text-muted)">
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
                                                <button
                                                    type="button"
                                                    class="btn-outline-gold btn-sm-ssc me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCandidateModal{{ $candidate->id }}"
                                                >
                                                    Edit
                                                </button>

                                                <form
                                                    action="{{ route('admin.candidates.delete', $candidate) }}"
                                                    method="POST"
                                                    style="display:inline-block"
                                                    onsubmit="return confirm('Remove this candidate?')"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn-danger-ssc">
                                                        Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editCandidateModal{{ $candidate->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content" style="background:#120000;color:var(--text-main);border:1px solid var(--border)">
                                                    <form action="{{ route('admin.candidates.update', $candidate) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-header" style="border-bottom:1px solid var(--border)">
                                                            <h5 class="modal-title" style="color:var(--gold-light)">
                                                                Edit Candidate
                                                            </h5>

                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Position</label>
                                                                    <select name="position_id" class="form-select" required>
                                                                        @foreach ($positions as $position)
                                                                            <option
                                                                                value="{{ $position->id }}"
                                                                                @selected($candidate->position_id === $position->id)
                                                                            >
                                                                                {{ $position->name }}
                                                                                @if ($position->college)
                                                                                    — {{ $position->college }}
                                                                                @endif
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">College</label>
                                                                    <select name="college" class="form-select" required>
                                                                        @foreach (['CASL', 'CBPA', 'CCS', 'CIT', 'CTE', 'CTHM'] as $college)
                                                                            <option value="{{ $college }}" @selected($candidate->college === $college)>
                                                                                {{ $college }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Last Name</label>
                                                                    <input
                                                                        type="text"
                                                                        name="last_name"
                                                                        class="form-control"
                                                                        value="{{ $candidate->last_name }}"
                                                                        required
                                                                    >
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">First Name</label>
                                                                    <input
                                                                        type="text"
                                                                        name="first_name"
                                                                        class="form-control"
                                                                        value="{{ $candidate->first_name }}"
                                                                        required
                                                                    >
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Partylist</label>
                                                                    <input
                                                                        type="text"
                                                                        name="partylist"
                                                                        class="form-control"
                                                                        value="{{ $candidate->partylist }}"
                                                                        placeholder="Optional"
                                                                    >
                                                                </div>

                                                                <div class="col-md-6 d-flex align-items-end">
                                                                    <label style="font-size:.85rem">
                                                                        <input
                                                                            type="checkbox"
                                                                            name="is_active"
                                                                            value="1"
                                                                            @checked($candidate->is_active)
                                                                        >
                                                                        Active candidate
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer" style="border-top:1px solid var(--border)">
                                                            <button type="button" class="btn-outline-gold" data-bs-dismiss="modal">
                                                                Cancel
                                                            </button>

                                                            <button type="submit" class="btn-gold">
                                                                Save Changes
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                            View, reset, and manage registered voters
                        </p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

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
                                        <th>Voted At</th>
                                        <th>Action</th>
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

                                            <td>
                                                @if ($voter->voted_at)
                                                    <span style="font-size:.75rem;color:var(--text-muted)">
                                                        {{ \Carbon\Carbon::parse($voter->voted_at)->format('M d, Y h:i A') }}
                                                    </span>
                                                @else
                                                    <span style="font-size:.75rem;color:var(--text-muted)">
                                                        —
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($voter->has_voted)
                                                    <form
                                                        action="{{ route('admin.voters.reset', $voter) }}"
                                                        method="POST"
                                                        style="display:inline-block"
                                                        onsubmit="return confirm('Reset this voter status? Their recorded votes will be deleted.')"
                                                    >
                                                        @csrf
                                                        @method('PUT')

                                                        <button type="submit" class="btn-outline-gold btn-sm-ssc me-1">
                                                            Reset
                                                        </button>
                                                    </form>
                                                @else
                                                    <button type="button" class="btn-outline-gold btn-sm-ssc me-1" disabled>
                                                        Reset
                                                    </button>
                                                @endif

                                                <form
                                                    action="{{ route('admin.voters.delete', $voter) }}"
                                                    method="POST"
                                                    style="display:inline-block"
                                                    onsubmit="return confirm('Remove this voter account?')"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn-danger-ssc">
                                                        Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align:center;color:var(--text-muted);padding:1rem">
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
