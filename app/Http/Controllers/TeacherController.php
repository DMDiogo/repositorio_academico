<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function statistics()
    {
        $user = Auth::user();
        
        // Get teacher's publications
        $publications = $user->publications()->with(['downloads', 'publicationType'])->get();
        
        // Calculate statistics
        $totalPublications = $publications->count();
        $totalDownloads = $publications->sum('download_count');
        $totalViews = $publications->sum('view_count');
        
        // Get downloads by publication type
        $downloadsByType = $publications->groupBy('publicationType.name')
            ->map(function ($group) {
                return $group->sum('download_count');
            });
            
        // Get recent downloads
        $recentDownloads = Download::whereIn('publication_id', $publications->pluck('id'))
            ->with(['publication', 'user'])
            ->latest()
            ->take(10)
            ->get();
            
        // Get most downloaded publications
        $mostDownloaded = $publications->sortByDesc('download_count')
            ->take(5);
            
        return view('teacher.statistics', compact(
            'totalPublications',
            'totalDownloads',
            'totalViews',
            'downloadsByType',
            'recentDownloads',
            'mostDownloaded'
        ));
    }
} 