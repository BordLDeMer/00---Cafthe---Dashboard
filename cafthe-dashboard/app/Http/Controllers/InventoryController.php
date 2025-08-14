<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $product = product::all();
        return view('inventory.index', compact('inventory'));
    }
}
et propose
