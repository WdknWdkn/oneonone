<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::resource('interviews', InterviewController::class);
