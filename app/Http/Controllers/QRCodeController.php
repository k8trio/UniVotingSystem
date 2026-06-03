<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QRCodeController extends Controller
{
    /**
     * Generate QR code for a user.
     */
    public function generateQRCode(User $user)
    {
        // If user doesn't have a QR token, generate one
        if (!$user->qr_code_token) {
            $user->qr_code_token = Str::random(32);
            $user->save();
        }

        // Create the QR code data with a unique verification URL
        $qrData = route('verify-qr', ['token' => $user->qr_code_token], false);

        try {
            $qrCode = QrCode::create($qrData)
                ->setWriter(new PngWriter());

            return response($qrCode->writeString())
                ->header('Content-Type', 'image/png')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to generate QR code',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get QR code data and image for the current user.
     */
    public function getQRCode(Request $request): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated',
            ], 401);
        }

        // Generate QR token if not exists
        if (!$user->qr_code_token) {
            $user->qr_code_token = Str::random(32);
            $user->save();
        }

        // Create QR code data
        $qrData = route('verify-qr', ['token' => $user->qr_code_token], false);

        try {
            $qrCode = QrCode::create($qrData)
                ->setWriter(new PngWriter());

            // Get base64 encoded image
            $qrImage = base64_encode($qrCode->writeString());

            return response()->json([
                'status' => 'success',
                'qr_image' => 'data:image/png;base64,' . $qrImage,
                'qr_token' => $user->qr_code_token,
                'qr_verified' => $user->qr_verified,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to generate QR code',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Verify QR code via token (called when QR code is scanned).
     */
    public function verifyQRCode(Request $request, $token): JsonResponse
    {
        $user = User::where('qr_code_token', $token)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid QR code token',
            ], 404);
        }

        if ($user->qr_verified) {
            return response()->json([
                'status' => 'success',
                'message' => 'QR code already verified',
                'qr_verified' => true,
                'user_name' => $user->name,
            ]);
        }

        // Mark as verified
        $user->update([
            'qr_verified' => true,
            'qr_verified_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'QR code verified successfully!',
            'qr_verified' => true,
            'user_name' => $user->name,
        ]);
    }

    /**
     * Check QR verification status.
     */
    public function checkQRStatus(Request $request): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated',
            ], 401);
        }

        return response()->json([
            'qr_verified' => $user->qr_verified,
            'qr_verified_at' => $user->qr_verified_at,
            'message' => $user->qr_verified ? 'QR code verified' : 'QR code not yet verified',
        ]);
    }
}
