<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Publication extends Model
{
    use HasFactory;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'abstract',
        'publication_date',
        'knowledge_area_id',
        'publication_type_id',
        'file_path',
        'file_type',
        'file_size',
        'page_count',
        'language',
        'doi',
        'issn',
        'download_count'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_date' => 'date',
    ];

    protected $dates = [
        'publication_date'
    ];

    /**
     * Get the user who uploaded the publication.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the knowledge area of the publication.
     */
    public function knowledgeArea(): BelongsTo
    {
        return $this->belongsTo(KnowledgeArea::class);
    }

    /**
     * Get the publication type.
     */
    public function publicationType(): BelongsTo
    {
        return $this->belongsTo(PublicationType::class);
    }

    /**
     * Get the authors of the publication.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)
            ->withPivot('is_main_author', 'order')
            ->withTimestamps();
    }

    /**
     * Get the keywords associated with the publication.
     */
    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class)->withTimestamps();
    }

    /**
     * Get the comments for the publication.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Obtém o autor da publicação.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtém as palavras-chave como array.
     */
    public function getKeywordsArrayAttribute(): array
    {
        return array_map('trim', explode(',', $this->keywords));
    }

    /**
     * Obtém o URL do arquivo.
     */
    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Get the publication's download records.
     */
    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    /**
     * Get total downloads count
     */
    public function getTotalDownloadsAttribute(): int
    {
        return $this->download_count ?? 0;
    }
}
