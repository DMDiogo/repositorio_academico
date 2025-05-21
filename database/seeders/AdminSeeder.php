<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the admin user.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@repositorio.com',
            'password' => Hash::make('admin123'),
            'user_type' => 'admin',
            'approval_status' => 'approved',
            'email_verified_at' => now(),
        ]);

        // Create admin profile
        UserProfile::create([
            'user_id' => $admin->id,
            'institution' => 'Repositório Acadêmico',
            'academic_title' => 'Administrador do Sistema',
            'bio' => 'Administrador do sistema do Repositório Acadêmico',
            'profile_visibility' => 'public',
        ]);
    }
}