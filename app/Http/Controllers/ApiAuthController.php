<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('student_id', $validated['login_id'])
            ->orWhere('username', $validated['login_id'])
            ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()
                ->json(['message' => 'Invalid credentials.'], 401)
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $token = $user->createToken('postman-token')->plainTextToken;

        return response()
            ->json([
                'token' => $token,
                'user' => $user,
            ])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()
            ->json(['message' => 'Logged out successfully.'])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}