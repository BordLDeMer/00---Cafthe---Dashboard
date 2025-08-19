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

        return view('dashboard', compact('balanceMensuelle', 'chiffreAffairesMois', 'meilleureVente', 'mauvaiseVente'));
    }
}
