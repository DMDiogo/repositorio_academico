<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArea;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = KnowledgeArea::all();
        return view('areas.index', compact('areas'));
    }

    public function show(KnowledgeArea $area)
    {
        $publications = $area->publications()->paginate(12);
        return view('areas.show', compact('area', 'publications'));
    }
}
