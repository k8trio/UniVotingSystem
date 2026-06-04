<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'required|in:voter,admin',
            'login_id' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validated['type'] === 'admin') {
            $user = User::where('username', $validated['login_id'])
                ->where('role', 'admin')
                ->first();
        } else {
            $user = User::where('student_id', $validated['login_id'])
                ->where('role', 'voter')
                ->first();
        }

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'redirect' => $user->role === 'admin' ? '/admin' : '/ballot',
            'user' => [
                'id' => $user->id,
                'student_id' => $user->student_id,
                'username' => $user->username,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'college' => $user->college,
                'year_and_section' => $user->year_and_section,
                'role' => $user->role,
                'has_voted' => $user->has_voted,
                'qr_code_token' => $user->qr_code_token,
            ],
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:255|unique:users,student_id',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'year_and_section' => 'required|string|max:255',
            'college' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'student_id' => $validated['student_id'],
            'username' => null,
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'year_and_section' => $validated['year_and_section'],
            'college' => $validated['college'],
            'password' => Hash::make($validated['password']),
            'role' => 'voter',
            'has_voted' => false,
            'qr_code_token' => Str::random(32),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Registration successful.',
            'redirect' => '/ballot',
            'user' => $user,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
            'redirect' => '/',
        ]);
    }

    public function me(): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated.',
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }
}