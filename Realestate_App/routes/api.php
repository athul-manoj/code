<?php

use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\Api\PhaseController;
use App\Http\Controllers\Api\WorkflowsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MessageTemplateController;
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

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/message-templates', [MessageTemplateController::class, 'store']);
    Route::put('/message-templates/{id}', [MessageTemplateController::class, 'update']);
    Route::delete('/message-templates/{id}', [MessageTemplateController::class, 'destroy']);
});

