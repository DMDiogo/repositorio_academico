<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    // ...existing code...

    public function statistics()
    {
        $totalUsers = User::where('approval_status', '!=', 'rejected')->count();
        $totalTeachers = User::where('user_type', 'teacher')
            ->where('approval_status', '!=', 'rejected')
            ->count();
        $totalStudents = User::where('user_type', 'student')
            ->where('approval_status', '!=', 'rejected')
            ->count();

        // ...existing code...

        return view('admin.statistics', compact(
            'totalUsers',
            'totalTeachers',
            'totalStudents',
            // ...existing code...
        ));
    }

    // ...existing code...
}
