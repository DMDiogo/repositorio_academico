<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\KnowledgeArea;
use App\Models\PublicationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicationController extends Controller
{
    /**
     * Mostrar o formulário de criação de publicação
     */
    public function create()
    {
        $knowledgeAreas = KnowledgeArea::all();
        $publicationTypes = PublicationType::all();
        
        return view('publications.create', compact('knowledgeAreas', 'publicationTypes'));
    }

    /**
     * Processar a criação de uma nova publicação
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'publication_date' => 'required|date',
            'knowledge_area_id' => 'required|exists:knowledge_areas,id',
            'publication_type_id' => 'required|exists:publication_types,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // max 10MB
            'page_count' => 'nullable|integer|min:1',
            'language' => 'required|string|max:10',
            'doi' => 'nullable|string|max:255',
            'issn' => 'nullable|string|max:255',
        ]);

        // Handle file upload
        $file = $request->file('file');
        $fileName = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('publications', $fileName, 'public');

        $publication = Publication::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'abstract' => $validated['abstract'],
            'publication_date' => $validated['publication_date'],
            'knowledge_area_id' => $validated['knowledge_area_id'],
            'publication_type_id' => $validated['publication_type_id'],
            'file_path' => $filePath,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize() / 1024, // Convert to KB
            'page_count' => $validated['page_count'],
            'language' => $validated['language'],
            'doi' => $validated['doi'],
            'issn' => $validated['issn'],
        ]);

        return redirect()->route('publications.show', $publication)
            ->with('success', 'Publicação criada com sucesso!');
    }

    /**
     * Mostrar uma publicação específica
     */
    public function show(Publication $publication)
    {
        return view('publications.show', compact('publication'));
    }

    public function index()
    {
        $publications = Publication::with(['author', 'knowledgeArea', 'publicationType'])
            ->latest()
            ->paginate(12);

        $knowledgeAreas = KnowledgeArea::all();
        $publicationTypes = PublicationType::all();

        return view('publications.index', compact('publications', 'knowledgeAreas', 'publicationTypes'));
    }
} 