<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiAuthController;

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