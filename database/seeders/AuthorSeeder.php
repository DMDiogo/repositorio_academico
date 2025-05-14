<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Seed the authors table.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Dr. Carlos Silva',
                'email' => 'carlos.silva@universidade.edu',
                'institution' => 'Universidade Federal de Tecnologia',
                'orcid' => '0000-0002-1234-5678',
                'bio' => 'Pesquisador na área de Inteligência Artificial e Computação Aplicada',
            ],
            [
                'name' => 'Dra. Ana Oliveira',
                'email' => 'ana.oliveira@instituto.edu',
                'institution' => 'Instituto de Pesquisas Biológicas',
                'orcid' => '0000-0001-2345-6789',
                'bio' => 'Especialista em biodiversidade de ecossistemas marinhos tropicais',
            ],
            [
                'name' => 'Prof. Ricardo Mendes',
                'email' => 'ricardo.mendes@faculdade.edu',
                'institution' => 'Faculdade de Filosofia',
                'orcid' => '0000-0003-3456-7890',
                'bio' => 'Pesquisador de questões éticas na era digital',
            ],
            [
                'name' => 'Dra. Mariana Costa',
                'email' => 'mariana.costa@universidade.edu',
                'institution' => 'Universidade Federal de Tecnologia',
                'orcid' => '0000-0004-4567-8901',
                'bio' => 'Especialista em visão computacional aplicada à indústria',
            ],
            [
                'name' => 'Dr. Fernando Santos',
                'email' => 'fernando.santos@universidade.edu',
                'institution' => 'Universidade Estadual de Ciências',
                'orcid' => '0000-0005-5678-9012',
                'bio' => 'Pesquisador em física de partículas',
            ],
            [
                'name' => 'Profa. Juliana Almeida',
                'email' => 'juliana.almeida@instituto.edu',
                'institution' => 'Instituto de Artes e Linguística',
                'orcid' => '0000-0006-6789-0123',
                'bio' => 'Especialista em literatura contemporânea',
            ],
            [
                'name' => 'Dr. Marcos Rodrigues',
                'email' => 'marcos.rodrigues@universidade.edu',
                'institution' => 'Universidade Federal de Direito',
                'orcid' => '0000-0007-7890-1234',
                'bio' => 'Pesquisador em direito constitucional',
            ],
            [
                'name' => 'Dra. Camila Ferreira',
                'email' => 'camila.ferreira@instituto.edu',
                'institution' => 'Instituto de Economia',
                'orcid' => '0000-0008-8901-2345',
                'bio' => 'Especialista em macroeconomia',
            ],
        ];

        foreach ($authors as $author) {
            DB::table('authors')->insert([
                'name' => $author['name'],
                'email' => $author['email'],
                'institution' => $author['institution'],
                'orcid' => $author['orcid'],
                'bio' => $author['bio'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 