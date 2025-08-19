<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\VendeurController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');

// Routes pour les ventes
Route::prefix('sales')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
});

// Routes pour l'inventaire
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

// Routes pour les clients
Route::resource('clients', ClientController::class);

// Routes pour les vendeurs
Route::get('/vendeurs/{vendeur}', [VendeurController::class, 'show'])->name('vendeurs.show');
Route::resource('vendeurs', VendeurController::class);
