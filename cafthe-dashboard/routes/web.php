<?php

use Illuminate\Support\Facades\Route;

    Route::get('/', function () {return view('welcome');});
    Route::get('/sales', [SaleController::class, 'index']);
    Route::get('/inventory', [InventoryController::class, 'index']);
    Route::get('/employees', [EmployeeController::class, 'index']);


