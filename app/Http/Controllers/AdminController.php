<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\User;
use App\Models\Vote;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $totalVoters = User::where('role', 'voter')->count();

        $votedCount = User::where('role', 'voter')
            ->where('has_voted', true)
            ->count();

        $notVotedCount = User::where('role', 'voter')
            ->where('has_voted', false)
            ->count();

        $totalCandidates = Candidate::count();

        $totalVoteEntries = Vote::count();

        $positions = Position::with(['candidates' => function ($query) {
                $query->orderBy('last_name')->orderBy('first_name');
            }])
            ->orderBy('display_order')
            ->get();

        $voteCounts = Vote::selectRaw('candidate_id, COUNT(*) as total_votes')
            ->whereNotNull('candidate_id')
            ->groupBy('candidate_id')
            ->pluck('total_votes', 'candidate_id');

        return view('admin', [
            'totalVoters' => $totalVoters,
            'votedCount' => $votedCount,
            'notVotedCount' => $notVotedCount,
            'totalCandidates' => $totalCandidates,
            'totalVoteEntries' => $totalVoteEntries,
            'positions' => $positions,
            'voteCounts' => $voteCounts,
        ]);
    }
}