<?php

use App\Http\Controllers\Api\InterviewApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/api/interviews', [InterviewApiController::class, 'index']);
    Route::delete('/api/interviews/{id}', [InterviewApiController::class, 'destroy']);
});
