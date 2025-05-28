<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArea;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalPublications = Publication::count();
        $totalUsers = User::count();
        $totalDownloads = Publication::sum('download_count');
        $totalViews = Publication::sum('view_count');
        
        $knowledgeAreas = KnowledgeArea::take(3)->get();
        
        $query = Publication::with('user')
            ->where(function($q) {
                if (auth()->check() && !auth()->user()->isAdmin()) {
                    $q->where('course', auth()->user()->course)
                      ->orWhere('course', 'fisica'); // Incluir publicações de física
                }
            })
            ->orderBy('created_at', 'desc');

        $recentPublications = $query->take(3)->get();

        return view('welcome_new', compact(
            'totalPublications',
            'totalUsers',
            'totalDownloads',
            'totalViews',
            'knowledgeAreas',
            'recentPublications'
        ));
    }
}
