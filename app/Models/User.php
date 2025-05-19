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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Obtém o perfil do usuário.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
    
    /**
     * Verifica se o usuário é administrador
     */
    public function isAdmin(): bool
    {
        return $this->email === 'admin@repositorio.com';
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
     * Get the publications for the user.
     */
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
