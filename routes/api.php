<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\VoteController;


Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);

    
    Route::get('/candidates', [ApiController::class, 'index']);
    Route::get('/candidates/{id}', [ApiController::class, 'show']);
    Route::post('/candidates', [ApiController::class, 'store']);
    Route::put('/candidates/{id}', [ApiController::class, 'update']);
    Route::patch('/candidates/{id}', [ApiController::class, 'patch']);
    Route::delete('/candidates', [ApiController::class, 'destroyAll']);
    Route::delete('/candidates/{id}', [ApiController::class, 'destroy']);

    
    Route::get('/voters', [ApiController::class, 'voters']);
    Route::get('/voters/{id}', [ApiController::class, 'showVoter']);
    Route::post('/voters', [ApiController::class, 'storeVoter']);
    Route::put('/voters/{id}', [ApiController::class, 'updateVoter']);
    Route::patch('/voters/{id}', [ApiController::class, 'patchVoter']);
    Route::delete('/voters', [ApiController::class, 'destroyAllVoters']);
    Route::delete('/voters/{id}', [ApiController::class, 'destroyVoter']);

    
    Route::get('/results', [ApiController::class, 'results']);
});
// Auth routes (no auth required)
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    Route::get('/qr-code', [QRCodeController::class, 'getQRCode']);
    Route::get('/qr-status', [QRCodeController::class, 'checkQRStatus']);
    Route::get('/qr-code/image', [QRCodeController::class, 'generateQRCode']);

    Route::get('/voting-status', [VoteController::class, 'checkVotingStatus']);
    Route::post('/submit-votes', [VoteController::class, 'submitVotes']);
    Route::get('/user-votes', [VoteController::class, 'getUserVotes']);
});