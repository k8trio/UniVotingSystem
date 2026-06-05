<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

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
}