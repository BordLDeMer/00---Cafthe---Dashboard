<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendeurController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;

// =============================================
// Routes publiques (accessibles sans authentification)
// =============================================

// Route d'accueil
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route pour la page home
Route::get('/home', [DashboardController::class, 'home'])->name('home');

// Routes pour l'authentification des vendeurs
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// =============================================
// Routes protégées (nécessitent une authentification)
// =============================================
// Route::middleware(['auth:vendeur'])->group(function () {

    // Routes pour les clients
    Route::resource('clients', ClientController::class);

    // Routes pour les vendeurs
    Route::resource('vendeurs', VendeurController::class);

    // Routes pour les produits
    Route::prefix('produits')->group(function () {
        Route::get('/', [ProduitController::class, 'index'])->name('produits.index');
        Route::get('/create', [ProduitController::class, 'create'])->name('produits.create');
        Route::post('/', [ProduitController::class, 'store'])->name('produits.store');
        Route::get('/search', [ProduitController::class, 'search'])->name('produits.search');
        Route::get('/{produit}', [ProduitController::class, 'show'])->name('produits.show');
        Route::get('/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
        Route::put('/{produit}', [ProduitController::class, 'update'])->name('produits.update');
});

    // Routes pour le panier
    Route::prefix('panier')->group(function () {
        Route::post('/ajouter/{id}', [PanierController::class, 'ajouterProduit'])->name('panier.ajouter');
        Route::get('/', [PanierController::class, 'voirPanier'])->name('panier.voir');
        Route::post('/supprimer/{id}', [PanierController::class, 'supprimerProduit'])->name('panier.supprimer');
        Route::post('/mettre-a-jour/{id}', [PanierController::class, 'mettreAJour'])->name('panier.mettre_a_jour');
        Route::post('/valider', [PanierController::class, 'validerAchat'])->name('panier.valider');
        Route::post('/vider', [PanierController::class, 'viderPanier'])->name('panier.vider');
    });

    // Routes pour afficher les commandes client
        Route::get('/commandes/client/{id_client}', [CommandeController::class, 'commandesParClient'])->name('commandes.client');
        Route::get('/commandes/{commande}', [CommandeController::class, 'details'])->name('commandes.details');
        Route::patch('/commandes/{commande}/statut', [CommandeController::class, 'updateStatut'])->name('commandes.updateStatut');

// });
