<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendeurController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Routes pour les clients
Route::resource('clients', ClientController::class);

// Routes pour les vendeurs
Route::resource('vendeurs', VendeurController::class);


