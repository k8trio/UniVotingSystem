<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\BallotController;
use App\Http\Controllers\TransparencyController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::get('/qr-verification', function () {
    return view('qr-verification');
})->name('qr-verification');

Route::get('/qr-scanner', function () {
    return view('qr-scanner');
})->name('qr-scanner');

Route::get('/verify-qr/{token}', [QRCodeController::class, 'verifyQRCode'])->name('verify-qr');

Route::middleware(['auth', 'role:voter'])->group(function () {
    Route::get('/ballot', [BallotController::class, 'index']);
    Route::view('/review', 'review');
    Route::view('/voted', 'voted');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/transparency', [TransparencyController::class, 'index']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

// Authentication routes
Route::post('/api/auth/login', [AuthController::class, 'login']);
Route::post('/api/auth/register', [AuthController::class, 'register']);
Route::post('/api/auth/logout', [AuthController::class, 'logout']);
Route::get('/api/auth/me', [AuthController::class, 'me']);

// QR Code routes
Route::get('/api/qr-code', [QRCodeController::class, 'getQRCode']);
Route::get('/api/qr-status', [QRCodeController::class, 'checkQRStatus']);
Route::get('/api/qr-code/image', [QRCodeController::class, 'generateQRCode']);

// Voting routes
Route::get('/api/voting-status', [VoteController::class, 'checkVotingStatus']);
Route::post('/api/submit-votes', [VoteController::class, 'submitVotes']);
Route::get('/api/user-votes', [VoteController::class, 'getUserVotes']);