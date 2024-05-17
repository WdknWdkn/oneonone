<?php

use App\Http\Controllers\Api\InterviewApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/interviews', [InterviewApiController::class, 'index']);
});
