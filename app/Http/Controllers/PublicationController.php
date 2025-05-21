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
        
        // Debug para verificar se os tipos de publicação estão sendo carregados
        \Log::debug('Tipos de publicação:', ['types' => $publicationTypes->toArray()]);
        
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

        $publication = new Publication();
        $publication->user_id = auth()->id();
        $publication->title = $validated['title'];
        $publication->slug = Str::slug($validated['title']); // Add this line
        $publication->abstract = $validated['abstract'];
        $publication->publication_date = $validated['publication_date'];
        $publication->knowledge_area_id = $validated['knowledge_area_id'];
        $publication->publication_type_id = $validated['publication_type_id'];
        $publication->file_path = $filePath;
        $publication->file_type = $file->getClientOriginalExtension();
        $publication->file_size = $file->getSize();
        $publication->page_count = $validated['page_count'] ?? 0;
        $publication->language = $validated['language'];
        $publication->doi = $validated['doi'];
        $publication->issn = $validated['issn'];
        $publication->download_count = 0;
        $publication->save();

        return redirect()->route('publications.index')
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
        $query = Publication::with(['author', 'knowledgeArea', 'publicationType']);
        
        // Se for professor, mostrar apenas suas publicações
        if (auth()->user()->role === 'professor') {
            $query->where('user_id', auth()->id());
        }

        $publications = $query->latest()->paginate(12);
        $knowledgeAreas = KnowledgeArea::all();
        $publicationTypes = PublicationType::all();

        return view('publications.index', compact('publications', 'knowledgeAreas', 'publicationTypes'));
    }

    public function download(Publication $publication)
    {
        // Increment download count
        $publication->increment('download_count');

        // Get the full path of the file
        $filePath = storage_path('app/public/' . $publication->file_path);

        // Generate the download name (slug + original extension)
        $downloadName = $publication->slug . '.' . $publication->file_type;

        // Return the file download response
        return response()->download($filePath, $downloadName);
    }

    public function myPublications()
    {
        $publications = Publication::with(['knowledgeArea', 'publicationType'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);

        return view('publications.my-publications', compact('publications'));
    }

    /**
     * Show the form for editing the specified publication.
     */
    public function edit(Publication $publication)
    {
        // Verify if the user owns this publication
        if ($publication->user_id !== auth()->id()) {
            abort(403);
        }

        $knowledgeAreas = KnowledgeArea::all();
        $publicationTypes = PublicationType::all();

        return view('publications.edit', compact('publication', 'knowledgeAreas', 'publicationTypes'));
    }

    /**
     * Update the specified publication in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        // Verify if the user owns this publication
        if ($publication->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'publication_date' => 'required|date',
            'knowledge_area_id' => 'required|exists:knowledge_areas,id',
            'publication_type_id' => 'required|exists:publication_types,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'page_count' => 'nullable|integer|min:1',
            'language' => 'required|string|max:10',
            'doi' => 'nullable|string|max:255',
            'issn' => 'nullable|string|max:255',
        ]);

        $publication->title = $validated['title'];
        $publication->slug = Str::slug($validated['title']);
        $publication->abstract = $validated['abstract'];
        $publication->publication_date = $validated['publication_date'];
        $publication->knowledge_area_id = $validated['knowledge_area_id'];
        $publication->publication_type_id = $validated['publication_type_id'];
        $publication->page_count = $validated['page_count'] ?? 0;
        $publication->language = $validated['language'];
        $publication->doi = $validated['doi'];
        $publication->issn = $validated['issn'];

        // Handle file upload if a new file is provided
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($publication->file_path);

            // Store new file
            $file = $request->file('file');
            $fileName = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('publications', $fileName, 'public');

            $publication->file_path = $filePath;
            $publication->file_type = $file->getClientOriginalExtension();
            $publication->file_size = $file->getSize();
        }

        $publication->save();

        return redirect()->route('publications.my-publications')
            ->with('success', 'Publicação atualizada com sucesso!');
    }

    public function destroy(Publication $publication)
    {
        // Verificar se o usuário é dono da publicação
        if ($publication->user_id !== auth()->id()) {
            abort(403);
        }

        // Deletar o arquivo físico
        Storage::disk('public')->delete($publication->file_path);

        // Deletar o registro do banco de dados
        $publication->delete();

        return redirect()->route('publications.my-publications')
            ->with('success', 'Publicação excluída com sucesso!');
    }

    public function preview(Publication $publication)
    {
        // Verifica se o usuário tem permissão para visualizar
        $this->authorize('view', $publication);

        // Incrementa o contador de visualizações
        $publication->increment('view_count');

        // Retorna o arquivo PDF com headers apropriados
        return response()->file(storage_path('app/public/' . $publication->file_path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $publication->title . '.pdf"',
        ]);
    }
}