<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PomodoroController;

Route::get('/pomodoro', [PomodoroController::class, 'index']);
Route::post('/pomodoro/save', [PomodoroController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
});