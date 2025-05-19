<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublicationTypeSeeder extends Seeder
{
    /**
     * Seed the publication types table.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Artigo Científico',
                'description' => 'Trabalho acadêmico que apresenta resultados de pesquisa científica.',
            ],
            [
                'name' => 'Tese',
                'description' => 'Trabalho acadêmico de conclusão de doutorado.',
            ],
            [
                'name' => 'Dissertação',
                'description' => 'Trabalho acadêmico de conclusão de mestrado.',
            ],
            [
                'name' => 'Monografia',
                'description' => 'Trabalho acadêmico de conclusão de curso de graduação.',
            ],
            [
                'name' => 'Livro',
                'description' => 'Obra completa sobre um tema específico.',
            ],
            [
                'name' => 'Capítulo de Livro',
                'description' => 'Parte de uma obra coletiva sobre um tema específico.',
            ],
            [
                'name' => 'Resumo Expandido',
                'description' => 'Versão resumida de um trabalho científico para apresentação em eventos.',
            ],
            [
                'name' => 'Relatório Técnico',
                'description' => 'Documento que descreve resultados de pesquisa ou desenvolvimento técnico.',
            ],
        ];

        foreach ($types as $type) {
            DB::table('publication_types')->insert([
                'name' => $type['name'],
                'slug' => Str::slug($type['name']),
                'description' => $type['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 