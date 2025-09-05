<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendeurController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// =============================================
// Fonction pour vérifier si le vendeur est un chef
// =============================================
function isChef($vendeur) {
    $chefVal = $vendeur->Chef ?? ($vendeur->chef ?? ($vendeur->is_chef ?? null));
    if (is_bool($chefVal)) {
        return $chefVal;
    } elseif (is_numeric($chefVal)) {
        return (int)$chefVal === 1;
    } elseif (is_string($chefVal)) {
        return in_array(strtolower(trim($chefVal)), ['oui', 'yes', '1']);
    }
    return false;
}

// =============================================
// Routes publiques (accessibles sans authentification)
// =============================================
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// =============================================
// Routes protégées (nécessitent une authentification)
// =============================================
Route::middleware(['auth:vendeur'])->group(function () {
    // Route d'accueil et home
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'home'])->name('home');

    // Routes pour les clients
    Route::resource('clients', ClientController::class);

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

    // Routes pour les commandes
    Route::get('/commandes/client/{id_client}', [CommandeController::class, 'commandesParClient'])->name('commandes.client');
    Route::get('/commandes/{commande}', [CommandeController::class, 'details'])->name('commandes.details');
    Route::patch('/commandes/{commande}/statut', [CommandeController::class, 'updateStatut'])->name('commandes.updateStatut');

    // Routes pour le profil du vendeur connecté (accessibles à tous les vendeurs)
    Route::get('/mon-profil', [VendeurController::class, 'monProfil'])->name('vendeurs.mon_profil');
    Route::get('/mon-profil/edit', [VendeurController::class, 'editMonProfil'])->name('vendeurs.edit_mon_profil');
    Route::put('/mon-profil', [VendeurController::class, 'mettreAJourMonProfil'])->name('vendeurs.mettre_a_jour_mon_profil');

    // Routes pour gérer les vendeurs (réservées aux chefs)
    Route::prefix('vendeurs')->group(function () {
        Route::get('/', function () {
            $vendeur = auth('vendeur')->user();
            if (!isChef($vendeur)) {
                abort(403, 'Accès réservé aux chefs.');
            }
            return app(VendeurController::class)->index();
        })->name('vendeurs.index');

        Route::get('/create', function () {
            $vendeur = auth('vendeur')->user();
            if (!isChef($vendeur)) {
                abort(403, 'Accès réservé aux chefs.');
            }
            return app(VendeurController::class)->create();
        })->name('vendeurs.create');

        Route::post('/', function (Request $request) {
            $vendeur = auth('vendeur')->user();
            if (!isChef($vendeur)) {
                abort(403, 'Accès réservé aux chefs.');
            }
            return app(VendeurController::class)->store($request);
        })->name('vendeurs.store');

        Route::get('/{vendeur}', function (App\Models\Vendeur $vendeur) {
            $currentVendeur = auth('vendeur')->user();
            if (!isChef($currentVendeur)) {
                abort(403, 'Accès réservé aux chefs.');
            }
            return app(VendeurController::class)->show($vendeur);
        })->name('vendeurs.show');

        Route::get('/{vendeur}/edit', function (App\Models\Vendeur $vendeur) {
            $currentVendeur = auth('vendeur')->user();
            if (!isChef($currentVendeur)) {
                abort(403, 'Accès réservé aux chefs.');
            }
            return app(VendeurController::class)->edit($vendeur);
        })->name('vendeurs.edit');

        Route::put('/{vendeur}', function (Request $request, App\Models\Vendeur $vendeur) {
            $currentVendeur = auth('vendeur')->user();
            if (!isChef($currentVendeur)) {
                abort(403, 'Accès réservé aux chefs.');
            }
            return app(VendeurController::class)->update($request, $vendeur);
        })->name('vendeurs.update');

        Route::delete('/{vendeur}', function (App\Models\Vendeur $vendeur) {
            $currentVendeur = auth('vendeur')->user();
            if (!isChef($currentVendeur)) {
                abort(403, 'Accès réservé aux chefs.');
            }
            return app(VendeurController::class)->destroy($vendeur);
        })->name('vendeurs.destroy');
    });
});
