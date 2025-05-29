<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Publication;
use App\Models\Download;
use Illuminate\Http\Request;

class AdminStatisticsController extends Controller
{
    public function index()
    {
        // Total statistics
        $totalUsers = User::where('approval_status', '!=', 'rejected')->count();
        $totalTeachers = User::where('user_type', 'teacher')
            ->where('approval_status', '!=', 'rejected')
            ->count();
        $totalStudents = User::where('user_type', 'student')
            ->where('approval_status', '!=', 'rejected')
            ->count();
        $totalPublications = Publication::count();
        $totalDownloads = Download::count();
        
        // Pending approvals
        $pendingTeachers = User::where('user_type', 'teacher')
            ->where('approval_status', 'pending')
            ->count();
        $pendingStudents = User::where('user_type', 'student')
            ->where('approval_status', 'pending')
            ->count();
            
        // Rejected users
        $rejectedTeachers = User::where('user_type', 'teacher')
            ->where('approval_status', 'rejected')
            ->count();
        $rejectedStudents = User::where('user_type', 'student')
            ->where('approval_status', 'rejected')
            ->count();
            
        // Publications by type
        $publicationsByType = Publication::selectRaw('publication_type_id, count(*) as count')
            ->groupBy('publication_type_id')
            ->with('publicationType')
            ->get();
            
        // Most downloaded publications
        $mostDownloaded = Publication::orderBy('download_count', 'desc')
            ->take(5)
            ->get();
            
        // Recent downloads
        $recentDownloads = Download::with(['publication', 'user'])
            ->latest()
            ->take(10)
            ->get();
            
        return view('admin.statistics', compact(
            'totalUsers',
            'totalTeachers',
            'totalStudents',
            'totalPublications',
            'totalDownloads',
            'pendingTeachers',
            'pendingStudents',
            'rejectedTeachers',
            'rejectedStudents',
            'publicationsByType',
            'mostDownloaded',
            'recentDownloads'
        ));
    }
} 