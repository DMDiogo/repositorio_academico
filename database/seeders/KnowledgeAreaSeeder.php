<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KnowledgeAreaSeeder extends Seeder
{
    /**
     * Seed the knowledge areas table.
     */
    public function run(): void
    {
        $areas = [
            [
                'name' => 'Ciências Exatas',
                'description' => 'Ciências que estudam fenômenos quantificáveis por meio de modelos matemáticos. Incluem matemática, física, química e estatística.',
                'color_class' => 'blue',
            ],
            [
                'name' => 'Ciências Biológicas',
                'description' => 'Ciências que estudam os seres vivos, suas características, comportamentos e interações. Incluem biologia, medicina, saúde e ecologia.',
                'color_class' => 'green',
            ],
            [
                'name' => 'Ciências Humanas',
                'description' => 'Ciências que estudam o ser humano e suas relações sociais, culturais e históricas. Incluem história, filosofia, sociologia e antropologia.',
                'color_class' => 'purple',
            ],
            [
                'name' => 'Ciências Sociais Aplicadas',
                'description' => 'Ciências que aplicam conhecimentos teóricos em áreas práticas relacionadas à sociedade. Incluem direito, economia, administração e comunicação.',
                'color_class' => 'yellow',
            ],
            [
                'name' => 'Engenharias',
                'description' => 'Áreas do conhecimento que aplicam princípios científicos para desenvolver soluções técnicas. Incluem engenharia civil, elétrica, mecânica e de computação.',
                'color_class' => 'red',
            ],
            [
                'name' => 'Linguística, Letras e Artes',
                'description' => 'Áreas que estudam a linguagem, a literatura e as expressões artísticas. Incluem linguística, literatura, música e artes visuais.',
                'color_class' => 'indigo',
            ],
        ];

        foreach ($areas as $area) {
            DB::table('knowledge_areas')->insert([
                'name' => $area['name'],
                'slug' => Str::slug($area['name']),
                'description' => $area['description'],
                'color_class' => $area['color_class'],
                'publication_count' => rand(50, 200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Add some subareas
        $exatasId = DB::table('knowledge_areas')->where('slug', 'ciencias-exatas')->first()->id;
        $biologicasId = DB::table('knowledge_areas')->where('slug', 'ciencias-biologicas')->first()->id;
        $humanasId = DB::table('knowledge_areas')->where('slug', 'ciencias-humanas')->first()->id;
        $sociaisId = DB::table('knowledge_areas')->where('slug', 'ciencias-sociais-aplicadas')->first()->id;
        $engenhariasId = DB::table('knowledge_areas')->where('slug', 'engenharias')->first()->id;
        $linguisticaId = DB::table('knowledge_areas')->where('slug', 'linguistica-letras-e-artes')->first()->id;

        $subareas = [
            // Exatas
            ['knowledge_area_id' => $exatasId, 'name' => 'Matemática'],
            ['knowledge_area_id' => $exatasId, 'name' => 'Física'],
            ['knowledge_area_id' => $exatasId, 'name' => 'Química'],
            ['knowledge_area_id' => $exatasId, 'name' => 'Estatística'],
            
            // Biológicas
            ['knowledge_area_id' => $biologicasId, 'name' => 'Biologia'],
            ['knowledge_area_id' => $biologicasId, 'name' => 'Medicina'],
            ['knowledge_area_id' => $biologicasId, 'name' => 'Ecologia'],
            ['knowledge_area_id' => $biologicasId, 'name' => 'Genética'],
            
            // Humanas
            ['knowledge_area_id' => $humanasId, 'name' => 'História'],
            ['knowledge_area_id' => $humanasId, 'name' => 'Filosofia'],
            ['knowledge_area_id' => $humanasId, 'name' => 'Sociologia'],
            ['knowledge_area_id' => $humanasId, 'name' => 'Antropologia'],
            
            // Sociais Aplicadas
            ['knowledge_area_id' => $sociaisId, 'name' => 'Direito'],
            ['knowledge_area_id' => $sociaisId, 'name' => 'Economia'],
            ['knowledge_area_id' => $sociaisId, 'name' => 'Administração'],
            ['knowledge_area_id' => $sociaisId, 'name' => 'Comunicação'],
            
            // Engenharias
            ['knowledge_area_id' => $engenhariasId, 'name' => 'Engenharia Civil'],
            ['knowledge_area_id' => $engenhariasId, 'name' => 'Engenharia Elétrica'],
            ['knowledge_area_id' => $engenhariasId, 'name' => 'Engenharia Mecânica'],
            ['knowledge_area_id' => $engenhariasId, 'name' => 'Computação'],
            
            // Linguística, Letras e Artes
            ['knowledge_area_id' => $linguisticaId, 'name' => 'Linguística'],
            ['knowledge_area_id' => $linguisticaId, 'name' => 'Literatura'],
            ['knowledge_area_id' => $linguisticaId, 'name' => 'Música'],
            ['knowledge_area_id' => $linguisticaId, 'name' => 'Artes Visuais'],
        ];

        foreach ($subareas as $subarea) {
            DB::table('knowledge_subareas')->insert([
                'knowledge_area_id' => $subarea['knowledge_area_id'],
                'name' => $subarea['name'],
                'slug' => Str::slug($subarea['name']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 