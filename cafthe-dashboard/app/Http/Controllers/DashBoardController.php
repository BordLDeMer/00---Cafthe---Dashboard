<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Produit;

class DashboardController extends Controller
{
    public function index()
    {
        $chiffreAffairesMois = Produit::chiffreAffairesMois();
        $meilleureVente = Produit::MeilleureVente();
        $mauvaiseVente = Produit::MauvaiseVente();

        return view('dashboard', compact('chiffreAffairesMois', 'meilleureVente', 'mauvaiseVente'));
    }


}
