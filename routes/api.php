<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::post('/registr', [AuthController::class, 'register']);
Route::post('/auth', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{course_id}', [CourseController::class, 'show']);
    Route::post('/courses/{course_id}/buy', [EnrollmentController::class, 'buy']);
    Route::get('/orders', [EnrollmentController::class, 'index']);
    Route::get('/orders/{id}', [EnrollmentController::class, 'cancel']);
});
