<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;

// Route d'accueil
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Routes pour les ventes
Route::prefix('sales')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/chiffre-affaires-mois', [VenteController::class, 'chiffreAffairesMois'])->name('sales.chiffre-affaires-mois');
});

// Routes pour l'inventaire
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

// Routes pour les employés
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

// Routes pour les clients
Route::prefix('clients')->group(function () {
    Route::get('/gestion', [ClientController::class, 'gestion'])->name('clients.gestion');
    Route::post('/', [ClientController::class, 'store'])->name('clients.store');
    Route::put('/{ID_client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/{ID_client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::get('/search', [ClientController::class, 'search'])->name('clients.search');
});
