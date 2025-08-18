<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');

// Routes pour les ventes
Route::prefix('sales')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
});

// Routes pour l'inventaire
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

// Routes pour les employés
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

// Routes pour les clients
Route::resource('clients', ClientController::class);

