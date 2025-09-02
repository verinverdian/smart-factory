<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard'); // biar root "/" langsung ke dashboard
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resources([
    'employees' => EmployeeController::class,
    'inventories' => InventoryController::class,
    'productions' => ProductionController::class,
]);
