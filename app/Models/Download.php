<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Download extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'publication_id',
        'ip_address',
        'user_agent'
    ];

    /**
     * Get the user who downloaded the publication.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the publication that was downloaded.
     */
    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
} 