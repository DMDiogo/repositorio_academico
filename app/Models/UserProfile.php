<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'institution',
        'academic_title',
        'bio',
        'orcid',
        'lattes_url',
        'website',
        'social_github',
        'social_linkedin',
        'social_twitter',
        'social_facebook',
        'profile_visibility',
    ];

    /**
     * Obtém o usuário dono deste perfil.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 