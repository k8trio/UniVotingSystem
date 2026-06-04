<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    /**
     * Check if the user has already voted.
     */
    public function checkVotingStatus(Request $request): JsonResponse
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated',
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'has_voted' => $user->has_voted,
            'voted_at' => $user->voted_at,
            'message' => $user->has_voted ? 'You have already voted.' : 'You can vote.',
        ]);
    }

    /**
     * Submit votes for the current user.
     */
    public function submitVotes(Request $request): JsonResponse
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated',
            ], 401);
        }

        $user = Auth::user();

        // Check if user has already voted
        if ($user->has_voted) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already voted. Each voter can only vote once.',
            ], 403);
        }

        // Validate the request
       $validated = $request->validate([
            'votes' => 'required|array|min:1',
            'votes.*.position_id' => 'required|integer|exists:positions,id',
            'votes.*.candidate_id' => 'required|integer|exists:candidates,id',
        ]);

        try {
            // Start a transaction to ensure all votes are saved or none are
            \DB::beginTransaction();

            // Store all votes
            foreach ($validated['votes'] as $voteData) {
                $candidate = Candidate::with('position')
                    ->where('id', $voteData['candidate_id'])
                    ->where('position_id', $voteData['position_id'])
                    ->firstOrFail();

                Vote::create([
                    'user_id' => $user->id,
                    'position_id' => $candidate->position_id,
                    'candidate_id' => $candidate->id,
                    'position' => $candidate->position->name,
                    'candidate_name' => $candidate->full_name,
                    'candidate_college' => $candidate->college,
                ]);
            }

            // Mark the user as having voted
            $user->update([
                'has_voted' => true,
                'voted_at' => now(),
            ]);

            \DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Your votes have been recorded successfully!',
                'voted_at' => $user->voted_at,
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while submitting your votes. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get all votes cast by the current user.
     */
    public function getUserVotes(Request $request): JsonResponse
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated',
            ], 401);
        }

        $user = Auth::user();
        $votes = Vote::where('user_id', $user->id)->get();

        return response()->json([
            'votes' => $votes,
            'has_voted' => $user->has_voted,
        ]);
    }
}
