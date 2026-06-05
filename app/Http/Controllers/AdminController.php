<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Exports\VotersExport;
use App\Exports\CandidatesExport;
use App\Exports\ResultsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

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

    public function resetVoter(User $user): RedirectResponse
    {
        $user->update([
            'has_voted' => false,
            'voted_at' => null,
        ]);

        Vote::where('user_id', $user->id)->delete();

        return redirect('/admin#voters')->with('success', 'Voter voting status has been reset.');
    }

    public function deleteVoter(User $user): RedirectResponse
    {
        if ($user->role === 'admin') {
            return redirect('/admin#voters')->with('success', 'Admin account cannot be removed here.');
        }

        $user->delete();

        return redirect('/admin#voters')->with('success', 'Voter removed successfully.');
    }

    public function exportVoters(string $format)
    {
        $voters = User::where('role', 'voter')
            ->orderBy('college')
            ->orderBy('last_name')
            ->get();

        $format = strtolower($format);

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('exports.voters', [
                'voters' => $voters,
            ])->setPaper('a4', 'portrait');

            return $pdf->download('voters_report.pdf');
        }

        if ($format === 'xlsx') {
            return Excel::download(
                new VotersExport($voters),
                'voters_report.xlsx'
            );
        }

        if ($format === 'csv') {
            return Excel::download(
                new VotersExport($voters),
                'voters_report.csv',
                \Maatwebsite\Excel\Excel::CSV
            );
        }

        if ($format === 'json') {
            return response()
                ->json($voters)
                ->setEncodingOptions(JSON_PRETTY_PRINT)
                ->header('Content-Disposition', 'attachment; filename="voters_report.json"');
        }

        abort(404);
    }

    public function exportCandidates(string $format)
    {
        $candidates = Candidate::with('position')
            ->orderBy('position_id')
            ->orderBy('last_name')
            ->get();

        $format = strtolower($format);

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('exports.candidates', [
                'candidates' => $candidates,
            ])->setPaper('a4', 'portrait');

            return $pdf->download('candidates_report.pdf');
        }

        if ($format === 'xlsx') {
            return Excel::download(
                new CandidatesExport($candidates),
                'candidates_report.xlsx'
            );
        }

        if ($format === 'csv') {
            return Excel::download(
                new CandidatesExport($candidates),
                'candidates_report.csv',
                \Maatwebsite\Excel\Excel::CSV
            );
        }

        if ($format === 'json') {
            return response()
                ->json($candidates)
                ->setEncodingOptions(JSON_PRETTY_PRINT)
                ->header('Content-Disposition', 'attachment; filename="candidates_report.json"');
        }

        abort(404);
    }

    public function exportResults(string $format)
    {
        $results = Candidate::with('position')
            ->withCount(['votes as total_votes'])
            ->orderBy('position_id')
            ->orderByDesc('total_votes')
            ->get();

        $format = strtolower($format);

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('exports.results', [
                'results' => $results,
            ]);

            return $pdf->download('results_report.pdf');
        }

        if ($format === 'xlsx') {
            return Excel::download(
                new ResultsExport($results),
                'results_report.xlsx'
            );
        }

        if ($format === 'csv') {
            return Excel::download(
                new ResultsExport($results),
                'results_report.csv',
                \Maatwebsite\Excel\Excel::CSV
            );
        }

        if ($format === 'json') {
            return response()
                ->json($results)
                ->setEncodingOptions(JSON_PRETTY_PRINT)
                ->header('Content-Disposition', 'attachment; filename="results_report.json"');
        }

        abort(404);
    }
}