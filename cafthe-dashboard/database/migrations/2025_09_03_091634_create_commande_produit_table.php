<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeProduitTable extends Migration
{
    public function up()
    {
        Schema::create('commande_produit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commande_id'); // Clé étrangère vers ID_commande
            $table->unsignedBigInteger('produit_id');
            $table->integer('quantite');
            $table->decimal('prix_unitaire', 10, 2);
            $table->timestamps();

            // Clés étrangères
            $table->foreign('commande_id')->references('ID_commande')->on('commande')->onDelete('cascade');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commande_produit');
    }
}
