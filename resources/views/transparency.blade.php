<x-layout>
    <div class="page active" id="page-transparency">
        <div class="container py-5">

            <div class="text-center mb-4">
                <h2 style="color:var(--blue-dark)">Transparency Dashboard</h2>
                <p style="color:var(--text-muted);font-size:.9rem">
                    Live vote summary based on submitted ballots.
                </p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="ssc-card text-center p-4">
                        <div class="stat-num">{{ $totalVoters }}</div>
                        <div class="stat-label">Registered Voters</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ssc-card text-center p-4">
                        <div class="stat-num">{{ $votedCount }}</div>
                        <div class="stat-label">Voters Submitted</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ssc-card text-center p-4">
                        <div class="stat-num">{{ $totalVotes }}</div>
                        <div class="stat-label">Total Vote Entries</div>
                    </div>
                </div>
            </div>

            <div class="ssc-card">
                <div class="ssc-card-header">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    Election Results
                </div>

                <div class="p-3">

                    @php $positionData = []; @endphp

                    @foreach ($positions as $position)
                        @php
                            $positionTotal = $position->candidates->sum(function ($c) use ($voteCounts) {
                                return $voteCounts[$c->id] ?? 0;
                            });
                            $positionData[] = [
                                'id' => $position->id,
                                'name' => $position->name,
                                'department' => strtoupper($position->department),
                                'college' => $position->college,
                                'total' => $positionTotal,
                                'candidates' => $position->candidates->map(function ($c) use ($voteCounts, $positionTotal) {
                                    $votes = $voteCounts[$c->id] ?? 0;
                                    return [
                                        'name' => $c->full_name,
                                        'partylist' => $c->partylist,
                                        'college' => $c->college,
                                        'votes' => $votes,
                                        'percent' => $positionTotal > 0 ? round(($votes / $positionTotal) * 100) : 0,
                                    ];
                                })->toArray(),
                            ];
                        @endphp
                    @endforeach

                    <div id="positions-container"></div>

                    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap gap-2">
                        <div style="font-size:.8rem;color:var(--text-muted)" id="page-info"></div>
                        <div class="d-flex gap-2" id="pagination-controls"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        const positions = @json($positionData);
        const PER_PAGE = 5;
        let currentPage = 1;
        const totalPages = () => Math.ceil(positions.length / PER_PAGE);

        function renderPositions() {
            const start = (currentPage - 1) * PER_PAGE;
            const slice = positions.slice(start, start + PER_PAGE);
            const container = document.getElementById('positions-container');

            container.innerHTML = slice.map(pos => `
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div style="color:var(--blue-dark);font-weight:700;font-family:'Cinzel',serif">
                                ${pos.name}
                            </div>
                            <div style="font-size:.75rem;color:var(--text-muted)">
                                ${pos.department}${pos.college ? ' • ' + pos.college : ''}
                            </div>
                        </div>
                        <span class="college-badge">${pos.total} vote${pos.total !== 1 ? 's' : ''}</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-ssc align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Candidate</th>
                                    <th>College</th>
                                    <th style="width:80px">Votes</th>
                                    <th style="width:220px">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${pos.candidates.length ? pos.candidates.map(c => `
                                    <tr>
                                        <td>
                                            <strong>${c.name}</strong>
                                            ${c.partylist ? `<div style="font-size:.75rem;color:var(--text-muted)">${c.partylist}</div>` : ''}
                                        </td>
                                        <td><span class="college-badge">${c.college}</span></td>
                                        <td>${c.votes}</td>
                                        <td>
                                            <div style="background:var(--blue-pale);border-radius:6px;height:8px;overflow:hidden">
                                                <div style="height:100%;width:${c.percent}%;background:linear-gradient(90deg,var(--blue),var(--yellow));border-radius:6px;transition:width .6s"></div>
                                            </div>
                                            <div style="font-size:.7rem;color:var(--text-muted);margin-top:.2rem">${c.percent}%</div>
                                        </td>
                                    </tr>
                                ).join('') : 
                                    <tr>
                                        <td colspan="4" class="text-center" style="color:var(--text-muted)">No candidates available.</td>
                                    </tr>
                                `}
                            </tbody>
                        </table>
                    </div>
                </div>
                ${start + slice.indexOf(pos) < start + slice.length - 1 ? '<hr style="border-color:var(--border);margin:1.5rem 0">' : ''}
            `).join('');

            document.getElementById('page-info').textContent =
                `Showing ${start + 1}–${Math.min(start + PER_PAGE, positions.length)} of ${positions.length} positions`;

            renderPagination();
        }

        function renderPagination() {
            const tp = totalPages();
            const ctrl = document.getElementById('pagination-controls');

            let html = `
                <button class="btn-page" onclick="goTo(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
                    <i class="bi bi-chevron-left"></i>
                </button>
            `;

            for (let i = 1; i <= tp; i++) {
                html += `<button class="btn-page ${i === currentPage ? 'active' : ''}" onclick="goTo(${i})">${i}</button>`;
            }

            html += `
                <button class="btn-page" onclick="goTo(${currentPage + 1})" ${currentPage === tp ? 'disabled' : ''}>
                    <i class="bi bi-chevron-right"></i>
                </button>
            `;

            ctrl.innerHTML = html;
        }

        function goTo(page) {
            const tp = totalPages();
            if (page < 1 || page > tp) return;
            currentPage = page;
            renderPositions();
            document.getElementById('positions-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        renderPositions();
    </script>

</x-layout>
