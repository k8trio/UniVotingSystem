<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Position;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function index()
    {
        return response()
            ->json(Candidate::with('position')->get())
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id)
    {
        $candidate = Candidate::with('position')->find($id);

        if (!$candidate) {
            return response()
                ->json(['message' => 'Candidate not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        return response()
            ->json($candidate)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'college' => 'required|string',
            'partylist' => 'nullable|string',
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

        return response()
            ->json($candidate, 201)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::find($id);

        if (!$candidate) {
            return response()
                ->json(['message' => 'Candidate not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'college' => 'required|string',
            'partylist' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $candidate->update($validated);

        return response()
            ->json($candidate)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function patch(Request $request, $id)
    {
        $candidate = Candidate::find($id);

        if (!$candidate) {
            return response()
                ->json(['message' => 'Candidate not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $validated = $request->validate([
            'position_id' => 'sometimes|exists:positions,id',
            'last_name' => 'sometimes|string',
            'first_name' => 'sometimes|string',
            'college' => 'sometimes|string',
            'partylist' => 'sometimes|nullable|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $candidate->update($validated);

        return response()
            ->json($candidate)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function destroy($id)
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

    public function destroyAll()
    {
        Candidate::truncate();

        return response()
            ->json(['message' => 'All candidates deleted successfully!'])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function voters()
    {
        return response()
            ->json(User::where('role', 'voter')->get())
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function showVoter($id)
    {
        $voter = User::where('role', 'voter')->find($id);

        if (!$voter) {
            return response()
                ->json(['message' => 'Voter not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        return response()
            ->json($voter)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function storeVoter(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|unique:users,student_id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'year_and_section' => 'required|string',
            'college' => 'required|string',
            'program' => 'nullable|string',
            'password' => 'required|string|min:6',
        ]);

        $voter = User::create([
            'student_id' => $validated['student_id'],
            'username' => null,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'year_and_section' => $validated['year_and_section'],
            'college' => $validated['college'],
            'program' => $validated['program'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'voter',
            'has_voted' => false,
        ]);

        return response()
            ->json($voter, 201)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function updateVoter(Request $request, $id)
    {
        $voter = User::where('role', 'voter')->find($id);

        if (!$voter) {
            return response()
                ->json(['message' => 'Voter not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $validated = $request->validate([
            'student_id' => 'required|string|unique:users,student_id,' . $id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'year_and_section' => 'required|string',
            'college' => 'required|string',
            'program' => 'nullable|string',
            'password' => 'nullable|string|min:6',
        ]);

        $voter->student_id = $validated['student_id'];
        $voter->first_name = $validated['first_name'];
        $voter->last_name = $validated['last_name'];
        $voter->year_and_section = $validated['year_and_section'];
        $voter->college = $validated['college'];
        $voter->program = $validated['program'] ?? null;

        if (!empty($validated['password'])) {
            $voter->password = Hash::make($validated['password']);
        }

        $voter->save();

        return response()
            ->json($voter)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function patchVoter(Request $request, $id)
    {
        $voter = User::where('role', 'voter')->find($id);

        if (!$voter) {
            return response()
                ->json(['message' => 'Voter not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $validated = $request->validate([
            'student_id' => 'sometimes|string|unique:users,student_id,' . $id,
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'year_and_section' => 'sometimes|string',
            'college' => 'sometimes|string',
            'program' => 'sometimes|nullable|string',
            'password' => 'sometimes|string|min:6',
            'has_voted' => 'sometimes|boolean',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $voter->update($validated);

        return response()
            ->json($voter)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function destroyVoter($id)
    {
        $voter = User::where('role', 'voter')->find($id);

        if (!$voter) {
            return response()
                ->json(['message' => 'Voter not found!'], 404)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $voter->delete();

        return response()
            ->json(['message' => 'Voter deleted successfully!'])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function destroyAllVoters()
    {
        User::where('role', 'voter')->delete();

        return response()
            ->json(['message' => 'All voters deleted successfully!'])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
}

    public function results()
    {
        $positions = Position::with('candidates')
            ->orderBy('display_order')
            ->get();

        $voteCounts = Vote::selectRaw('candidate_id, COUNT(*) as total_votes')
            ->whereNotNull('candidate_id')
            ->groupBy('candidate_id')
            ->pluck('total_votes', 'candidate_id');

        $results = $positions->map(function ($position) use ($voteCounts) {
            return [
                'position' => $position->name,
                'department' => $position->department,
                'college' => $position->college,
                'candidates' => $position->candidates->map(function ($candidate) use ($voteCounts) {
                    return [
                        'candidate_id' => $candidate->id,
                        'candidate_name' => $candidate->full_name,
                        'college' => $candidate->college,
                        'votes' => $voteCounts[$candidate->id] ?? 0,
                    ];
                }),
            ];
        });

        return response()
            ->json($results)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}