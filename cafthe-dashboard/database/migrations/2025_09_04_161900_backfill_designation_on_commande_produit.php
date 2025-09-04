<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('commande_produit') && Schema::hasTable('produit')) {
            // Remplit la désignation manquante à partir de la table produits
            DB::statement("UPDATE commande_produit cp JOIN produit p ON p.ID_produit = cp.produit_id SET cp.designation_produit = p.designation_produit WHERE cp.designation_produit IS NULL OR cp.designation_produit = ''");
        }
    }

    public function down(): void
    {
        // On ne supprime pas les valeurs remontées; on laisse tel quel
    }
};
