<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataImportController;
use App\Http\Controllers\Api\ProposalGroupApiController;
use App\Http\Controllers\Api\ProposalApiController;
use App\Http\Controllers\Api\RubricApiController;
use App\Http\Controllers\Api\MetadataApiController;
use App\Http\Controllers\Api\ExtraApiController;
use App\Http\Controllers\Api\ModelTestingController;
use App\Http\Controllers\Api\EvaluationResultController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Data Import API (untuk training/test data)
Route::prefix('data')->group(function () {
    Route::post('/import', [DataImportController::class, 'import']);
    Route::get('/status', [DataImportController::class, 'status']);
});

// Web Bima Integration APIs
Route::prefix('bima')->group(function () {
    // Proposal Groups API
    Route::post('/proposal-groups', [ProposalGroupApiController::class, 'import']);
    Route::get('/proposal-groups', [ProposalGroupApiController::class, 'index']);

    // Rubrics API
    Route::post('/rubrics', [RubricApiController::class, 'import']);
    Route::get('/rubrics', [RubricApiController::class, 'index']);

    // Metadata API
    Route::post('/metadata', [MetadataApiController::class, 'import']);
    Route::get('/metadata', [MetadataApiController::class, 'index']);
    
    // Extras API
    Route::post('/extras', [ExtraApiController::class, 'import']);
    Route::get('/extras', [ExtraApiController::class, 'index']);
});

// AI Model Testing APIs
Route::prefix('model')->group(function () {
    // Direct test - send data directly without proposal_group_id
    Route::post('/direct-test', [ModelTestingController::class, 'directTest']);

    // Group-based testing (commented out, use direct-test for now)
    // Route::post('/test', [ModelTestingController::class, 'runTest']);
    // Route::post('/batch-test', [ModelTestingController::class, 'runBatchTest']);
});

// Evaluation Result API - untuk menerima hasil dari pihak ketiga
Route::post('/evaluation-result', [EvaluationResultController::class, 'store']);

// Evaluation Test API - untuk testing dari tools page
Route::post('/evaluation-test', [EvaluationResultController::class, 'test']);

// Proposal Group Proposals API - untuk load proposals by group
Route::get('/proposal-groups/{id}/proposals', [ProposalGroupApiController::class, 'getProposals']);

// Proposal Group Status API - untuk cek status grup
Route::get('/proposal-groups/{id}/status', [ProposalGroupApiController::class, 'getStatus']);

// Proposal API - untuk menerima/mengelola JSON per proposal
Route::post('/proposals/{id}/accept-json', [ProposalApiController::class, 'acceptJson']);
Route::get('/proposals/{id}/json', [ProposalApiController::class, 'getJson']);

// Proposal Evaluation Detail API - untuk menerima JSON hasil evaluasi detail per proposal
Route::post('/proposals/{proposal_id}/evaluation-detail', [ProposalApiController::class, 'saveDetailJson']);
