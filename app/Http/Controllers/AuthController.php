<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
            'type' => 'required|in:voter,admin',
        ]);

        $user = User::where('student_id', $validated['login_id'])
            ->orWhere('email', $validated['login_id'])
            ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials.',
            ], 401);
        }

        if ($validated['type'] === 'admin' && $user->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'This account is not an admin account.',
            ], 403);
        }

        if ($validated['type'] === 'voter' && $user->role !== 'voter') {
            return response()->json([
                'status' => 'error',
                'message' => 'This account is not a voter account.',
            ], 403);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'user' => $user,
            'redirect' => $user->role === 'admin' ? '/admin' : '/ballot',
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
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'year_and_section' => $validated['year_and_section'],
            'college' => $validated['college'],
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['student_id'] . '@univote.local',
            'password' => Hash::make($validated['password']),
            'role' => 'voter',
            'has_voted' => false,
            'qr_code_token' => Str::random(32),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful.',
            'user' => $user,
            'redirect' => '/ballot',
        ], 201);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully.',
            'redirect' => '/',
        ]);
    }

    public function me(): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not authenticated.',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }
}