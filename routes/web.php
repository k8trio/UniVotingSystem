<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::get('/ballot', function () {
    return view('ballot');
});

Route::get('/review', function () {
    return view('review');
});

Route::get('/voted', function () {
    return view('voted');
});

Route::get('/transparency', function () {
    return view('transparency');
});

Route::get('/admin', function () {
    return view('admin');
});

// Authentication routes
Route::post('/api/auth/login', [AuthController::class, 'login']);
Route::post('/api/auth/register', [AuthController::class, 'register']);
Route::post('/api/auth/logout', [AuthController::class, 'logout']);
Route::get('/api/auth/me', [AuthController::class, 'me']);

// Voting routes
Route::get('/api/voting-status', [VoteController::class, 'checkVotingStatus']);
Route::post('/api/submit-votes', [VoteController::class, 'submitVotes']);
Route::get('/api/user-votes', [VoteController::class, 'getUserVotes']);