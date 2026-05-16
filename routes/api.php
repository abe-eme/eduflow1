<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
use App\Http\Controllers\AI\AiLessonController;

Route::post('/ai/generate-lesson', [AiLessonController::class, 'generateLesson']);
