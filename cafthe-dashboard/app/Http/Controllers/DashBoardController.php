<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        // Calcule le chiffre d'affaires du mois en cours
        $debutMois = now()->startOfMonth()->toDateString();
        $finMois = now()->endOfMonth()->toDateString();
        $chiffreAffairesMois = Vente::whereBetween('created_at', [$debutMois, $finMois])
            ->sum('total_sales_last_month');

        // Passe la variable à la vue
        return view('dashboard')

    }
}
