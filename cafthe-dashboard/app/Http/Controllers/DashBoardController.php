<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Produit;

class DashBoardController extends BaseController
{
    public function index()
    {
        $balanceMensuelle = Produit::balanceMensuelle();
        $chiffreAffairesMois = Produit::chiffreAffairesMois();
        $meilleureVente = Produit::MeilleureVente();
        $mauvaiseVente = Produit::MauvaiseVente();

        // Récupération des produits dont le stock est inférieur à 5, triés par ordre croissant de stock
        $produitsFaibleStock = Produit::where('stock', '<', 5)
            ->orderBy('stock', 'asc')
            ->get();

        return view('dashboard', compact('balanceMensuelle', 'chiffreAffairesMois', 'meilleureVente', 'mauvaiseVente', 'produitsFaibleStock'));
    }

    public function home()
    {
        return view('home');
    }
}
