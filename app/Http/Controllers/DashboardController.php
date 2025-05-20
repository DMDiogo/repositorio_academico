<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $publications = Publication::where('user_id', $user->id)
            ->latest()
            ->get();

        $totalDownloads = $publications->sum('download_count');
        $mostDownloaded = $publications->sortByDesc('download_count')->first();

        return view('dashboard', compact('publications', 'totalDownloads', 'mostDownloaded'));
    }
}