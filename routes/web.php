<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttributionController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('niveaux')->group(function(){
        Route::get('/', [LevelsController::class, 'index'])->name('niveaux');
    });
    Route::prefix('settings')->group(function(){
        Route::get('/', [SchoolYearController::class, 'index'])->name('settings');
        Route::get('/create-school-year', [SchoolYearController::class, 'create'])->name('settings.create_school_year');
        Route::get('/create-level', [LevelsController::class, 'create'])->name('settings.create_levels');
        Route::get('/edit-level/{level}', [LevelsController::class, 'edit'])->name('settings.edit_level');
    });
    Route::prefix('classes')->group(function(){
        Route::get('/', [ClassController::class, 'index'])->name('classes');
        Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
        Route::get('/edit/{classe}', [ClassController::class, 'edit'])->name('classes.edit');
    });
    Route::prefix('eleves')->group(function(){
        Route::get('/', [StudentController::class, 'index'])->name('students');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::get('/edit/{student}', [StudentController::class, 'edit'])->name('students.edit');
        Route::get('/{student}', [StudentController::class, 'show'])->name('students.show');
    });
    Route::prefix('Inscription')->group(function(){
        Route::get('/', [AttributionController::class, 'index'])->name('Inscriptions');
        Route::get('/create', [AttributionController::class, 'create'])->name('inscriptions.create');
        Route::get('/edit/{attribution}',[AttributionController::class, 'edit'])->name('inscriptions.edit');
    });
    Route::prefix('payments')->group(function(){
        Route::get('/', [PaymentController::class, 'index'])->name('payments');
        Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::get('/edit/{payment}', [PaymentController::class, 'edit'])->name('payments.edit');
    });
    Route::prefix('parents')->group(function(){
        Route::get('/', [ParentController::class, 'index'])->name('parents');
        Route::get('/create', [ParentController::class, 'create'])->name('parents.create');
        Route::get('/edit{parent}', [ParentController::class, 'create'])->name('parents.edit');
        Route::get('/payments/{payment}/print', [PaymentController::class, 'print'])->name('payments.print');
    });
    Route::prefix('frais')->group(function(){
        Route::get('/', [FeesController::class, 'index'])->name('fees');
        Route::get('/create', [FeesController::class, 'create'])->name('fees.create');
        Route::get('/edit/{fee}', [FeesController::class, 'edit'])->name('fees.edit');
    });
});
