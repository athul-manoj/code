<?php

use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\Api\PhaseController;
use App\Http\Controllers\Api\WorkflowsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('phase')->group(function(){
    Route::get('/',[PhaseController::class,'index']);
    Route::post('/',[PhaseController::class,'store']);
    Route::get('/{id}',[PhaseController::class,'show']);
    Route::put('/{id}',[PhaseController::class,'update']);
    Route::delete('/{id}',[PhaseController::class,'destroy']);
    });
Route::prefix('workflows')->group(function(){
    Route::get('/',[WorkflowsController::class,'index']);
    Route::post('/',[WorkflowsController::class,'store']);
    Route::get('/{id}',[WorkflowsController::class,'show']);
    Route::put('/{id}',[WorkflowsController::class,'update']);
    Route::delete('/{id}',[WorkflowsController::class,'destroy']);
    });
Route::post('/update-lead-status/{lead_id}/{workflow_id}',[LeadController::class, 'updateLeadStatus']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
