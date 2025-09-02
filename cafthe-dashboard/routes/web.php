<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendeurController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); //->middleware('auth:vendeur')
// Route pour la page home
Route::get('/home', [DashboardController::class, 'home'])->name('home'); //->middleware('auth:vendeur')
// Routes pour les clients
Route::resource('clients', ClientController::class); //->middleware('auth:vendeur')
// Routes pour les vendeurs
Route::resource('vendeurs', VendeurController::class); //->middleware('auth:vendeur')
// Routes pour l'authentification des vendeurs
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Routes pour les produits
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/produits/search', [ProduitController::class, 'search'])->name('produits.search');

// Routes pour le panier
Route::post('/panier/ajouter/{id}', [PanierController::class, 'ajouterProduit'])->name('panier.ajouter');
Route::get('/panier', [PanierController::class, 'voirPanier'])->name('panier.voir');
Route::post('/panier/supprimer/{id}', [PanierController::class, 'supprimerProduit'])->name('panier.supprimer');
Route::post('/panier/valider', [PanierController::class, 'validerAchat'])->name('panier.valider');
Route::post('/panier/mettre-a-jour/{id}', [PanierController::class, 'mettreAJour'])->name('panier.mettre_a_jour');
Route::post('/panier/vider', [PanierController::class, 'viderPanier'])->name('panier.vider');
