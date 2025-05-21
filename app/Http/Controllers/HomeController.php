<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArea;
use App\Models\Publication;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $knowledgeAreas = KnowledgeArea::take(3)->get();
        $recentPublications = Publication::with(['author', 'knowledgeArea'])
            ->orderBy('publication_date', 'desc')
            ->take(3)
            ->get();

        return view('welcome_new', compact('knowledgeAreas', 'recentPublications'));
    }
}
