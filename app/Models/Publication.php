<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'knowledge_area_id',
        'publication_type_id',
        'title',
        'slug',
        'abstract',
        'publication_date',
        'page_count',
        'file_path',
        'file_type',
        'file_size',
        'download_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_date' => 'date',
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
}
