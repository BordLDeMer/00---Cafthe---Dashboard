<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendeurController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); //->middleware('auth:vendeur');

// Route pour la page home
Route::get('/home', [DashboardController::class, 'home'])->name('home'); //->middleware('auth:vendeur');

// Routes pour les clients
Route::resource('clients', ClientController::class); //->middleware('auth:vendeur');

// Routes pour les vendeurs
Route::resource('vendeurs', VendeurController::class); //->middleware('auth:vendeur');

// Routes pour l'authentification des vendeurs
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

