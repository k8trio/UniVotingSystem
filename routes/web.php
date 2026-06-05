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

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

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
    Route::post('/submit-votes', [VoteController::class, 'submitVotes']);
    Route::get('/voting-status', [VoteController::class, 'checkVotingStatus']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/transparency', [TransparencyController::class, 'index']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/admin/candidates', [AdminController::class, 'storeCandidate'])
        ->name('admin.candidates.store');
    Route::put('/admin/candidates/{candidate}', [AdminController::class, 'updateCandidate'])
        ->name('admin.candidates.update');
    Route::delete('/admin/candidates/{candidate}', [AdminController::class, 'deleteCandidate'])
        ->name('admin.candidates.delete');
    Route::put('/admin/voters/{user}/reset', [AdminController::class, 'resetVoter'])
        ->name('admin.voters.reset');
    Route::delete('/admin/voters/{user}', [AdminController::class, 'deleteVoter'])
        ->name('admin.voters.delete');
    Route::get('/admin/export/voters/{format}', [AdminController::class, 'exportVoters'])
        ->name('admin.export.voters');
    Route::get('/admin/export/candidates/{format}', [AdminController::class, 'exportCandidates'])
        ->name('admin.export.candidates');
    Route::get('/admin/export/results/{format}', [AdminController::class, 'exportResults'])
        ->name('admin.export.results');
});

