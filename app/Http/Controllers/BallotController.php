<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\View\View;

class BallotController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $positions = Position::with(['candidates' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('last_name')
                    ->orderBy('first_name');
            }])
            ->where(function ($query) use ($user) {
                $query->whereNull('college')
                    ->orWhere('college', $user->college);
            })
            ->orderBy('display_order')
            ->get();

        return view('ballot', [
            'user' => $user,
            'executivePositions' => $positions->where('department', 'executive')->values(),
            'legislativePositions' => $positions->where('department', 'legislative')->values(),
        ]);
    }
}