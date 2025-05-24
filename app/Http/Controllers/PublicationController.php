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
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
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
        $publication->slug = Str::slug($validated['title']);
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

    public function index(Request $request)
    {
        $query = Publication::query();

        // Filtro por área de conhecimento
        if ($request->filled('area')) {
            $query->where('knowledge_area_id', $request->area);
        }

        // Filtro por tipo de publicação
        if ($request->filled('tipo')) {
            $query->where('publication_type_id', $request->tipo);
        }

        // Filtro por ano
        if ($request->filled('ano')) {
            if ($request->ano === 'anterior') {
                $query->whereYear('publication_date', '<', now()->year - 5);
            } else {
                $query->whereYear('publication_date', $request->ano);
            }
        }

        // Busca por texto
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('abstract', 'like', '%' . $request->search . '%');
            });
        }

        // Ordenação
        switch ($request->get('ordenar', 'recentes')) {
            case 'antigos':
                $query->orderBy('publication_date', 'asc');
                break;
            case 'downloads':
                $query->orderBy('download_count', 'desc');
                break;
            case 'alfabetica':
                $query->orderBy('title', 'asc');
                break;
            default: // recentes
                $query->orderBy('publication_date', 'desc');
        }

        $publications = $query->with(['user', 'knowledgeArea', 'publicationType'])->paginate(10);
        $knowledgeAreas = KnowledgeArea::all();
        $publicationTypes = PublicationType::all();

        if ($request->ajax()) {
            return view('publications._list', compact('publications'))->render();
        }

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

    /**
     * Show the form for editing the specified publication.
     */
    public function edit(Publication $publication)
    {
        // Permitir acesso ao admin ou ao dono da publicação
        if (!auth()->user()->isAdmin() && $publication->user_id !== auth()->id()) {
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
        // Permitir acesso ao admin ou ao dono da publicação
        if (!auth()->user()->isAdmin() && $publication->user_id !== auth()->id()) {
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

        return redirect()->route('my-publications')
            ->with('success', 'Publicação atualizada com sucesso!');
    }

    public function destroy(Publication $publication)
    {
        // Permitir acesso ao admin ou ao dono da publicação
        if (!auth()->user()->isAdmin() && $publication->user_id !== auth()->id()) {
            abort(403);
        }

        // Deletar o arquivo físico
        Storage::disk('public')->delete($publication->file_path);

        // Deletar o registro do banco de dados
        $publication->delete();

        return redirect()->route('my-publications')
            ->with('success', 'Publicação excluída com sucesso!');
    }

    public function myPublications()
    {
        $publications = auth()->user()->publications()->latest()->paginate(10);
        return view('publications.my-publications', compact('publications'));
    }

    public function preview(Publication $publication)
    {
        // Increment view count
        $publication->increment('view_count');

        // Get the full path of the file
        $filePath = storage_path('app/public/' . $publication->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado');
        }

        // Handle different file types
        switch (strtolower($publication->file_type)) {
            case 'pdf':
                return response()->file($filePath, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
                ]);

            case 'doc':
            case 'docx':
                // Convert DOC/DOCX to HTML for preview
                $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);
                $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
                
                ob_start();
                $htmlWriter->save('php://output');
                $html = ob_get_clean();

                return response()->view('publications.preview', [
                    'publication' => $publication,
                    'content' => $html
                ]);

            default:
                abort(400, 'Formato de arquivo não suportado para preview');
        }
    }
}