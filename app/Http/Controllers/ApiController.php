<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function candidates(): JsonResponse
    {
        $candidates = Candidate::with('position')
            ->orderBy('position_id')
            ->orderBy('last_name')
            ->get()
            ->map(function ($candidate) {
                return [
                    'id' => $candidate->id,
                    'position_id' => $candidate->position_id,
                    'position' => $candidate->position->name ?? null,
                    'last_name' => $candidate->last_name,
                    'first_name' => $candidate->first_name,
                    'full_name' => $candidate->full_name,
                    'college' => $candidate->college,
                    'partylist' => $candidate->partylist,
                    'is_active' => (bool) $candidate->is_active,
                ];
            });

        return response()
            ->json($candidates)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function showCandidate($id): JsonResponse
    {
        $candidate = Candidate::with('position')->find($id);

        if (!$candidate) {
            return response()
                ->json(['message' => 'Candidate not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        return response()
            ->json([
                'id' => $candidate->id,
                'position_id' => $candidate->position_id,
                'position' => $candidate->position->name ?? null,
                'last_name' => $candidate->last_name,
                'first_name' => $candidate->first_name,
                'full_name' => $candidate->full_name,
                'college' => $candidate->college,
                'partylist' => $candidate->partylist,
                'is_active' => (bool) $candidate->is_active,
            ])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function storeCandidate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'college' => 'required|string|max:255',
            'partylist' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $candidate = Candidate::create([
            'position_id' => $validated['position_id'],
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'college' => $validated['college'],
            'partylist' => $validated['partylist'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        $candidate->load('position');

        return response()
            ->json([
                'id' => $candidate->id,
                'position_id' => $candidate->position_id,
                'position' => $candidate->position->name ?? null,
                'last_name' => $candidate->last_name,
                'first_name' => $candidate->first_name,
                'full_name' => $candidate->full_name,
                'college' => $candidate->college,
                'partylist' => $candidate->partylist,
                'is_active' => (bool) $candidate->is_active,
            ], 201)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function updateCandidate(Request $request, $id): JsonResponse
    {
        $candidate = Candidate::find($id);

        if (!$candidate) {
            return response()
                ->json(['message' => 'Candidate not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'college' => 'required|string|max:255',
            'partylist' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $candidate->update($validated);
        $candidate->load('position');

        return response()
            ->json([
                'id' => $candidate->id,
                'position_id' => $candidate->position_id,
                'position' => $candidate->position->name ?? null,
                'last_name' => $candidate->last_name,
                'first_name' => $candidate->first_name,
                'full_name' => $candidate->full_name,
                'college' => $candidate->college,
                'partylist' => $candidate->partylist,
                'is_active' => (bool) $candidate->is_active,
            ])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function patchCandidate(Request $request, $id): JsonResponse
    {
        $candidate = Candidate::find($id);

        if (!$candidate) {
            return response()
                ->json(['message' => 'Candidate not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $validated = $request->validate([
            'position_id' => 'sometimes|exists:positions,id',
            'last_name' => 'sometimes|string|max:255',
            'first_name' => 'sometimes|string|max:255',
            'college' => 'sometimes|string|max:255',
            'partylist' => 'sometimes|nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $candidate->update($validated);
        $candidate->load('position');

        return response()
            ->json([
                'id' => $candidate->id,
                'position_id' => $candidate->position_id,
                'position' => $candidate->position->name ?? null,
                'last_name' => $candidate->last_name,
                'first_name' => $candidate->first_name,
                'full_name' => $candidate->full_name,
                'college' => $candidate->college,
                'partylist' => $candidate->partylist,
                'is_active' => (bool) $candidate->is_active,
            ])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function deleteCandidate($id): JsonResponse
    {
        $candidate = Candidate::find($id);

        if (!$candidate) {
            return response()
                ->json(['message' => 'Candidate not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $candidate->delete();

        return response()
            ->json(['message' => 'Candidate deleted successfully!'])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function deleteAllCandidates(): JsonResponse
    {
        Candidate::truncate();

        return response()
            ->json(['message' => 'All candidates deleted successfully!'])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function results(): JsonResponse
    {
        $positions = Position::with('candidates')
            ->orderBy('display_order')
            ->get();

        $voteCounts = Vote::selectRaw('candidate_id, COUNT(*) as total_votes')
            ->whereNotNull('candidate_id')
            ->groupBy('candidate_id')
            ->pluck('total_votes', 'candidate_id');

        $results = $positions->map(function ($position) use ($voteCounts) {
            $positionTotal = $position->candidates->sum(function ($candidate) use ($voteCounts) {
                return $voteCounts[$candidate->id] ?? 0;
            });

            return [
                'position_id' => $position->id,
                'position' => $position->name,
                'department' => $position->department,
                'college' => $position->college,
                'total_votes' => $positionTotal,
                'candidates' => $position->candidates->map(function ($candidate) use ($voteCounts, $positionTotal) {
                    $candidateVotes = $voteCounts[$candidate->id] ?? 0;

                    return [
                        'candidate_id' => $candidate->id,
                        'candidate_name' => $candidate->full_name,
                        'college' => $candidate->college,
                        'votes' => $candidateVotes,
                        'percentage' => $positionTotal > 0
                            ? round(($candidateVotes / $positionTotal) * 100, 2)
                            : 0,
                    ];
                })->values(),
            ];
        });

        return response()
            ->json($results)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function voters(): JsonResponse
    {
        $voters = User::where('role', 'voter')
            ->orderBy('college')
            ->orderBy('last_name')
            ->get()
            ->map(function ($voter) {
                return [
                    'id' => $voter->id,
                    'student_id' => $voter->student_id,
                    'name' => $voter->last_name . ', ' . $voter->first_name,
                    'college' => $voter->college,
                    'year_and_section' => $voter->year_and_section,
                    'has_voted' => (bool) $voter->has_voted,
                    'voted_at' => $voter->voted_at,
                ];
            });

        return response()
            ->json($voters)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function showVoter($id): JsonResponse
    {
        $voter = User::where('role', 'voter')->find($id);

        if (!$voter) {
            return response()
                ->json(['message' => 'Voter not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        return response()
            ->json([
                'id' => $voter->id,
                'student_id' => $voter->student_id,
                'name' => $voter->last_name . ', ' . $voter->first_name,
                'college' => $voter->college,
                'year_and_section' => $voter->year_and_section,
                'has_voted' => (bool) $voter->has_voted,
                'voted_at' => $voter->voted_at,
            ])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}