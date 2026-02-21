<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Веб-авторизация и регистрация
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registr', [AuthController::class, 'showRegister'])->name('register');
Route::post('/registr', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Личный кабинет студента
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/courses/{course}', [StudentController::class, 'showCourse'])->name('student.course');
    Route::post('/courses/{course}/enroll', [StudentController::class, 'enroll'])->name('student.enroll');
    Route::delete('/enrollments/{enrollment}', [StudentController::class, 'cancelEnroll'])->name('student.cancel');
});

// Админ-панель
Route::prefix('course-admin')->middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('admin.dashboard');
    Route::resource('courses', CourseController::class);
    Route::resource('lessons', LessonController::class);
    Route::get('students', [AdminStudentController::class, 'index'])->name('admin.students');
});
