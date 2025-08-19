<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\VendeurController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Routes pour les ventes
Route::prefix('sales')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
});

// Routes pour l'inventaire
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

// Routes pour les clients
Route::resource('clients', ClientController::class);

// Routes pour les vendeurs
Route::resource('vendeurs', VendeurController::class);

Route::post('/vendeurs', [VendeurController::class, 'store'])->name('vendeurs.store');
Route::get('/vendeurs/create', [VendeurController::class, 'create'])->name('vendeurs.create');
Route::get('/vendeurs', [VendeurController::class, 'index'])->name('vendeurs.index');

