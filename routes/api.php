<?php

use App\Http\Controllers\Api\InterviewApiController;
use App\Http\Controllers\Api\InterviewAnswerApiController;
use App\Http\Controllers\Api\TemplateApiController;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/api/interviews', [InterviewApiController::class, 'index']);
    Route::delete('/api/interviews/{id}', [InterviewApiController::class, 'destroy']);

    Route::post('/api/interviews/{id}/answers', [InterviewAnswerApiController::class, 'store']);

});