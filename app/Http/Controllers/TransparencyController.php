<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\Vote;
use Illuminate\View\View;

class TransparencyController extends Controller
{
    public function index(): View
    {
        $positions = Position::with(['candidates' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('last_name')
                    ->orderBy('first_name');
            }])
            ->orderBy('display_order')
            ->get();

        $voteCounts = Vote::selectRaw('candidate_id, COUNT(*) as total_votes')
            ->whereNotNull('candidate_id')
            ->groupBy('candidate_id')
            ->pluck('total_votes', 'candidate_id');

        $totalVotes = Vote::count();

        $totalVoters = \App\Models\User::where('role', 'voter')->count();

        $votedCount = \App\Models\User::where('role', 'voter')
            ->where('has_voted', true)
            ->count();

        return view('transparency', [
            'positions' => $positions,
            'voteCounts' => $voteCounts,
            'totalVotes' => $totalVotes,
            'totalVoters' => $totalVoters,
            'votedCount' => $votedCount,
        ]);
    }
}
