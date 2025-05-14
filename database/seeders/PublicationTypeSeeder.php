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
                'description' => 'Trabalho acadêmico que apresenta resultados de uma pesquisa científica específica.',
            ],
            [
                'name' => 'Tese',
                'description' => 'Trabalho acadêmico apresentado como requisito para obtenção do título de doutor.',
            ],
            [
                'name' => 'Dissertação',
                'description' => 'Trabalho acadêmico apresentado como requisito para obtenção do título de mestre.',
            ],
            [
                'name' => 'Monografia',
                'description' => 'Trabalho acadêmico de conclusão de curso de graduação ou especialização.',
            ],
            [
                'name' => 'Livro',
                'description' => 'Obra acadêmica ou literária completa.',
            ],
            [
                'name' => 'Capítulo de Livro',
                'description' => 'Parte específica de uma obra acadêmica ou literária.',
            ],
            [
                'name' => 'Trabalho de Conclusão de Curso',
                'description' => 'Trabalho final apresentado para conclusão de curso de graduação.',
            ],
            [
                'name' => 'Relatório Técnico',
                'description' => 'Documento que descreve detalhes técnicos de um projeto ou pesquisa aplicada.',
            ],
            [
                'name' => 'Anais de Congresso',
                'description' => 'Publicação contendo os trabalhos apresentados em congressos ou eventos científicos.',
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