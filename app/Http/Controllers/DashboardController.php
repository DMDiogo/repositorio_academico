<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        $publications = Publication::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('publications'));
    }
} 