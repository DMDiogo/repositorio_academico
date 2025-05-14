<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table.
     */
    public function run(): void
    {
        // Create admin user
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Administrador',
            'email' => 'admin@repositorio.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create some regular users
        $users = [
            [
                'name' => 'Carlos Silva',
                'email' => 'carlos.silva@universidade.edu',
                'title' => 'Dr.',
                'institution' => 'Universidade Federal de Tecnologia',
                'academic_title' => 'Professor de Engenharia da Computação',
                'bio' => 'Pesquisador na área de Inteligência Artificial e Computação Aplicada',
            ],
            [
                'name' => 'Ana Oliveira',
                'email' => 'ana.oliveira@instituto.edu',
                'title' => 'Dra.',
                'institution' => 'Instituto de Pesquisas Biológicas',
                'academic_title' => 'Pesquisadora Sênior em Ecologia Marinha',
                'bio' => 'Especialista em biodiversidade de ecossistemas marinhos tropicais',
            ],
            [
                'name' => 'Ricardo Mendes',
                'email' => 'ricardo.mendes@faculdade.edu',
                'title' => 'Prof.',
                'institution' => 'Faculdade de Filosofia',
                'academic_title' => 'Professor de Ética e Filosofia Contemporânea',
                'bio' => 'Pesquisador de questões éticas na era digital',
            ],
            [
                'name' => 'Mariana Costa',
                'email' => 'mariana.costa@universidade.edu',
                'title' => 'Dra.',
                'institution' => 'Universidade Federal de Tecnologia',
                'academic_title' => 'Professora de Sistemas de Visão Computacional',
                'bio' => 'Especialista em visão computacional aplicada à indústria',
            ],
        ];

        foreach ($users as $user) {
            $userId = DB::table('users')->insertGetId([
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('senha' . rand(100, 999)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create user profile
            DB::table('user_profiles')->insert([
                'user_id' => $userId,
                'institution' => $user['institution'],
                'academic_title' => $user['academic_title'],
                'bio' => $user['bio'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 