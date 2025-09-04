<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('commande_produit') && !Schema::hasColumn('commande_produit', 'designation_produit')) {
            Schema::table('commande_produit', function (Blueprint $table) {
                $table->string('designation_produit')->nullable()->after('produit_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('commande_produit') && Schema::hasColumn('commande_produit', 'designation_produit')) {
            Schema::table('commande_produit', function (Blueprint $table) {
                $table->dropColumn('designation_produit');
            });
        }
    }
};
