<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductionController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resources([
    'employees' => EmployeeController::class,
    'inventories' => InventoryController::class,
    'productions' => ProductionController::class,
]);



