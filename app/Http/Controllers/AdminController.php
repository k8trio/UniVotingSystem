<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $totalVoters = User::where('role', 'voter')->count();

        $votesCast = User::where('role', 'voter')
            ->where('has_voted', true)
            ->count();

        $turnout = $totalVoters > 0
            ? round(($votesCast / $totalVoters) * 100, 1)
            : 0;

        $totalCandidates = Candidate::count();

        $collegeStats = User::where('role', 'voter')
            ->selectRaw('college, COUNT(*) as total')
            ->groupBy('college')
            ->orderBy('college')
            ->get()
            ->map(function ($row) {
                $votes = User::where('role', 'voter')
                    ->where('college', $row->college)
                    ->where('has_voted', true)
                    ->count();

                return [
                    'college' => $row->college,
                    'votes' => $votes,
                    'total' => $row->total,
                    'percent' => $row->total > 0 ? round(($votes / $row->total) * 100) : 0,
                ];
            });

        $positions = Position::with(['candidates' => function ($query) {
                $query->orderBy('last_name')->orderBy('first_name');
            }])
            ->orderBy('display_order')
            ->get();

        $candidates = Candidate::with('position')
            ->orderBy('position_id')
            ->orderBy('last_name')
            ->get();

        $voters = User::where('role', 'voter')
            ->orderBy('college')
            ->orderBy('last_name')
            ->get();

        $voteCounts = Vote::selectRaw('candidate_id, COUNT(*) as total_votes')
            ->whereNotNull('candidate_id')
            ->groupBy('candidate_id')
            ->pluck('total_votes', 'candidate_id');

        return view('admin', [
            'totalVoters' => $totalVoters,
            'votesCast' => $votesCast,
            'turnout' => $turnout,
            'totalCandidates' => $totalCandidates,
            'collegeStats' => $collegeStats,
            'positions' => $positions,
            'candidates' => $candidates,
            'voters' => $voters,
            'voteCounts' => $voteCounts,
        ]);
    }

    public function storeCandidate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'college' => 'required|string|max:255',
            'partylist' => 'nullable|string|max:255',
        ]);

        Candidate::create([
            'position_id' => $validated['position_id'],
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'college' => $validated['college'],
            'partylist' => $validated['partylist'] ?? null,
            'is_active' => true,
        ]);

        return redirect('/admin#candidates')->with('success', 'Candidate added successfully.');
    }

    public function updateCandidate(Request $request, Candidate $candidate): RedirectResponse
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'college' => 'required|string|max:255',
            'partylist' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $candidate->update([
            'position_id' => $validated['position_id'],
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'college' => $validated['college'],
            'partylist' => $validated['partylist'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect('/admin#candidates')->with('success', 'Candidate updated successfully.');
    }

    public function deleteCandidate(Candidate $candidate): RedirectResponse
    {
        $candidate->delete();

        return redirect('/admin#candidates')->with('success', 'Candidate removed successfully.');
    }
}