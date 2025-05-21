<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('approval_status', 'pending')
            ->where('user_type', '!=', 'admin')
            ->get();

        return view('dashboard', compact('pendingUsers'));
    }
}