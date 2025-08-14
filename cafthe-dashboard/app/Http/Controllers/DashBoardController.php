<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Produit;

class DashboardController extends Controller
{
    public function index()
    {
        $chiffreAffairesMois = (new \App\Models\Sale)->chiffreAffairesMois();
        $meilleureVente = Produit::orderBy('ventes', 'desc')->first();
        $mauvaiseVente = Produit::orderBy('ventes', 'asc')->first();

        return view('dashboard', compact('chiffreAffairesMois', 'meilleureVente', 'mauvaiseVente'));
    }

}
