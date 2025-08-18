<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EX\Controller;

class InventoryController extends Controller
{
    public function index()
    {
        $product = product::all();
        return view('inventory.index', compact('inventory'));
    }
}
et propose
