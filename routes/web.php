<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PondController;
use App\Http\Controllers\WaterLogController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('landing');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Analisis Kelayakan Air
    Route::get('/analyzer', [DashboardController::class, 'showAnalyzer'])->name('analyzer');
    Route::post('/analyzer/process', [DashboardController::class, 'processAnalyzer'])->name('analyzer.process');

    // Konsultasi Budidaya
    Route::get('/consultation', [DashboardController::class, 'showConsultation'])->name('consultation');
    Route::post('/consultation/process', [DashboardController::class, 'processConsultation'])->name('consultation.process');

    // Ponds (Kolam) CRUD
    Route::get('/ponds', [PondController::class, 'index'])->name('ponds.index');
    // Admin only routes for writing/deleting ponds
    Route::middleware('role:admin')->group(function () {
        Route::post('/ponds', [PondController::class, 'store'])->name('ponds.store');
        Route::put('/ponds/{pond}', [PondController::class, 'update'])->name('ponds.update');
        Route::delete('/ponds/{pond}', [PondController::class, 'destroy'])->name('ponds.destroy');
    });

    // Water Logs (Catatan Kualitas Air) CRUD
    Route::get('/water-logs', [WaterLogController::class, 'index'])->name('water-logs.index');
    Route::post('/water-logs', [WaterLogController::class, 'store'])->name('water-logs.store');
    Route::get('/water-logs/{waterLog}/edit', [WaterLogController::class, 'edit'])->name('water-logs.edit');
    Route::put('/water-logs/{waterLog}', [WaterLogController::class, 'update'])->name('water-logs.update');
    // Admin only route for deleting water logs
    Route::delete('/water-logs/{waterLog}', [WaterLogController::class, 'destroy'])->name('water-logs.destroy');
});
