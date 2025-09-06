<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// 🔑 Route untuk login & logout (tanpa middleware auth)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// 📊 Semua route utama butuh auth
Route::middleware('auth')->group(function () {

    // Root diarahkan ke dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Export manual CSV produksi
    Route::get(
        '/productions/export-manual',
        [ProductionController::class, 'exportCsvManual']
    )->name('productions.exportManual');

    // Resource routes
    Route::resources([
        'employees'   => EmployeeController::class,
        'inventories' => InventoryController::class,
        'productions' => ProductionController::class,
    ]);
});
