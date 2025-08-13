<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {

        $chiffreAffairesMois = (new \App\Models\Sale)->chiffreAffairesMois();

        return view('dashboard', compact('chiffreAffairesMois'));

    }
}
