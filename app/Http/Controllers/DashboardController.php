<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Remover a query de pendingUsers
        return view('dashboard');
    }
}