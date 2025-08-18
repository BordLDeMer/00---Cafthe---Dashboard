<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EX\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employees::all();
        return view('employees.index', compact('employees'));
    }
}
