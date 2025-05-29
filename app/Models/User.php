<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_type',
        'password',
        'role',
        'approval_status',
        'rejection_reason',
        'course',  // Add this line
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    /**
     * Obtém o perfil do usuário.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
    
    /**
     * Verifica se o usuário é um professor
     */
    public function isTeacher(): bool
    {
        return $this->user_type === 'teacher';
    }

    /**
     * Verifica se o usuário é um aluno
     */
    public function isStudent(): bool
    {
        return $this->user_type === 'student';
    }

    /**
     * Verifica se o usuário é um administrador
     */
    public function isAdmin(): bool
    {
        return $this->user_type === 'admin';
    }

    /**
     * Check if the user is approved
     */
    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Check if the user is pending approval
     */
    public function isPending(): bool
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Check if the user is rejected
     */
    public function isRejected(): bool
    {
        return $this->approval_status === 'rejected';
    }

    /**
     * Get the publications for the user.
     */
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    /**
     * Get the downloads made by the user.
     */
    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}
