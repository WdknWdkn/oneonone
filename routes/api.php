<?php

use App\Http\Controllers\Api\InterviewApiController;
use App\Http\Controllers\Api\InterviewAnswerApiController;
use App\Http\Controllers\Api\TemplateApiController;
use App\Http\Controllers\Api\UserDepartmentApiController;
use App\Http\Controllers\Api\UserPositionApiController;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/api/interviews', [InterviewApiController::class, 'index']);
    Route::delete('/api/interviews/{id}', [InterviewApiController::class, 'destroy']);
    Route::post('/api/interviews/{id}/answers', [InterviewAnswerApiController::class, 'store']);
    
    Route::get('/api/user-departments', [UserDepartmentApiController::class, 'index']);
    Route::get('/api/user-positions', [UserPositionApiController::class, 'index']);
});