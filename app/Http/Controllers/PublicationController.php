<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\PublicationType;
use App\Models\KnowledgeArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use FPDF; // Change this import
use PhpOffice\PhpWord\IOFactory; // Para DOCX
use App\Models\Download;

class PublicationController extends Controller
{
    /**
     * Mostrar o formulário de criação de publicação
     */
    public function create()
    {
        $publicationTypes = PublicationType::all();
        return view('publications.create', compact('publicationTypes'));
    }

    /**
     * Processar a criação de uma nova publicação
     */
    public function store(Request $request)
    {
        // Validação dos campos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string',
            'discipline' => 'required|string',
            'abstract' => 'required|string',
            'publication_type_id' => 'required|exists:publication_types,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'language' => 'required|string|max:10',
            'publication_date' => 'required|date',
            'doi' => 'nullable|string|max:255',
            'issn' => 'nullable|string|max:255',
        ]);

        $publication = new Publication();
        $publication->title = $validated['title'];
        $publication->course = $validated['course'];
        $publication->discipline = $validated['discipline'];
        $publication->abstract = $validated['abstract'];
        $publication->publication_type_id = $validated['publication_type_id'];
        $publication->language = $validated['language'];
        $publication->publication_date = $validated['publication_date'];
        $publication->doi = $validated['doi'];
        $publication->issn = $validated['issn'];
        $publication->user_id = auth()->id();
        $publication->knowledge_area_id = null;
        $publication->slug = Str::slug($validated['title']);
        
        // Upload do arquivo
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('publications', $fileName, 'public');
            
            $publication->file_path = $filePath;
            $publication->file_type = $file->getClientOriginalExtension();
            $publication->file_size = $file->getSize();

            // Detectar número de páginas
            $fullPath = storage_path('app/public/' . $filePath);
            $pageCount = $this->getPageCount($fullPath, $file->getClientOriginalExtension());
            $publication->page_count = $pageCount;
        }

        $publication->download_count = 0;
        $publication->save();

        return redirect()->route('publications.index')
            ->with('success', 'Publicação criada com sucesso!');
    }

    /**
     * Detecta o número de páginas do documento
     */
    private function getPageCount($filePath, $fileType)
    {
        try {
            switch (strtolower($fileType)) {
                case 'pdf':
                    return $this->getPdfPageCount($filePath);
                
                case 'doc':
                case 'docx':
                    return $this->getDocxPageCount($filePath);
                
                default:
                    return 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getPdfPageCount($filePath)
    {
        // Load PDF file
        $pageCount = 0;
        if (file_exists($filePath)) {
            $pdf = file_get_contents($filePath);
            $pageCount = preg_match_all("/\/Page\W/", $pdf);
        }
        return $pageCount;
    }

    private function getDocxPageCount($filePath)
    {
        $phpWord = IOFactory::load($filePath);
        $pageCount = 0;
        
        foreach ($phpWord->getSections() as $section) {
            $pageCount += ceil($section->getStyle()->getPageSizeW() / 
                             $section->getStyle()->getPageSizeH());
        }
        
        return $pageCount;
    }

    /**
     * Mostrar uma publicação específica
     */
    public function show(Publication $publication)
    {
        $user = auth()->user();
        
        // Se o usuário for um professor ou admin, pode ver qualquer publicação
        if ($user->isTeacher() || $user->isAdmin()) {
            return view('publications.show', compact('publication'));
        }
        
        // Se for um aluno, verifica se tem curso definido
        if ($user->isStudent()) {
            if (!$user->course) {
                abort(403, 'Você precisa ter um curso definido para visualizar publicações.');
            }
            
            // Comparação case-insensitive dos cursos
            if (strtolower($user->course) !== strtolower($publication->course)) {
                abort(403, 'Você não tem permissão para visualizar esta publicação. Esta publicação é do curso ' . $publication->course . '.');
            }
        }
        
        return view('publications.show', compact('publication'));
    }

    public function index(Request $request)
    {
        $query = Publication::query();

        // Filtrar apenas publicações do curso do aluno
        if (auth()->user()->user_type === 'student') {
            $query->where('course', auth()->user()->course);
        }

        // Buscar por título
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filtrar por tipo de publicação
        if ($request->filled('tipo')) {
            $query->where('publication_type_id', $request->tipo);
        }

        // Filtrar por ano
        if ($request->filled('ano')) {
            if ($request->ano === 'anterior') {
                $query->whereYear('created_at', '<', now()->subYears(5)->year);
            } else {
                $query->whereYear('created_at', $request->ano);
            }
        }

        // Ordenação
        switch ($request->get('ordenar', 'recentes')) {
            case 'antigos':
                $query->orderBy('created_at', 'asc');
                break;
            case 'downloads':
                $query->orderBy('download_count', 'desc');
                break;
            case 'alfabetica':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $publications = $query->paginate(10)->withQueryString();
        $publicationTypes = PublicationType::all();

        return view('publications.index', compact('publications', 'publicationTypes'));
    }

    public function download(Publication $publication)
    {
        // Create download record
        Download::create([
            'user_id' => auth()->id(),
            'publication_id' => $publication->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

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

        $publicationTypes = PublicationType::all();
        $knowledgeAreas = KnowledgeArea::all();

        return view('publications.edit', compact('publication', 'publicationTypes', 'knowledgeAreas'));
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
            'knowledge_area_id' => 'required|exists:knowledge_areas,id',
            'publication_type_id' => 'required|exists:publication_types,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'language' => 'required|string|max:10',
        ]);

        $publication->title = $validated['title'];
        $publication->slug = Str::slug($validated['title']);
        $publication->abstract = $validated['abstract'];
        $publication->knowledge_area_id = $validated['knowledge_area_id'];
        $publication->publication_type_id = $validated['publication_type_id'];
        $publication->language = $validated['language'];

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

        // Redirecionar baseado no tipo de usuário
        if (auth()->user()->isAdmin()) {
            return redirect()->route('publications.index')
                ->with('success', 'Publicação excluída com sucesso!');
        }

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