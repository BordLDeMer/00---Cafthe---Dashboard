<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

    Route::get('/', function () {return view('welcome');});
    Route::get('/sales', [SaleController::class, 'index']);
    Route::get('/inventory', [InventoryController::class, 'index']);
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
