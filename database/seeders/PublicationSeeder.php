<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublicationSeeder extends Seeder
{
    /**
     * Seed the publications and related tables.
     */
    public function run(): void
    {
        // Get IDs for foreign keys
        $knowledgeAreas = DB::table('knowledge_areas')->get();
        $publicationTypes = DB::table('publication_types')->get();
        $users = DB::table('users')->get();
        $authors = DB::table('authors')->get();
        
        // Create some example keywords
        $keywords = [
            'Inteligência Artificial', 'Machine Learning', 'Deep Learning', 'Automação Industrial',
            'Biodiversidade', 'Ecossistemas Marinhos', 'Conservação Ambiental',
            'Ética', 'Filosofia Contemporânea', 'Tecnologia',
            'Visão Computacional', 'Controle de Qualidade', 'Indústria 4.0',
            'Física Quântica', 'Partículas', 'Literatura Brasileira', 'Literatura Contemporânea',
            'Direito Constitucional', 'Economia', 'Macroeconomia', 'Internet das Coisas',
            'Clima', 'Sustentabilidade', 'Educação', 'Saúde Pública', 'Genética'
        ];
        
        // Insert keywords
        $keywordIds = [];
        foreach ($keywords as $keyword) {
            $keywordIds[] = DB::table('keywords')->insertGetId([
                'name' => $keyword,
                'slug' => Str::slug($keyword),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Create sample publications
        $publications = [
            [
                'title' => 'Avanços em Inteligência Artificial: aplicações na indústria 4.0',
                'abstract' => 'Este artigo discute as aplicações mais recentes de algoritmos de inteligência artificial no contexto da indústria 4.0, com foco em automação e otimização de processos industriais. Analisamos como as tecnologias de machine learning, deep learning e visão computacional estão sendo implementadas para melhorar a eficiência, reduzir custos e aumentar a produtividade em diferentes setores industriais.',
                'publication_date' => '2023-06-12',
                'user_id' => $users[1]->id ?? $users[0]->id,
                'knowledge_area_id' => $this->getIdBySlug($knowledgeAreas, 'engenharias'),
                'publication_type_id' => $this->getIdBySlug($publicationTypes, 'artigo-cientifico'),
                'page_count' => 32,
                'file_type' => 'pdf',
                'file_size' => 2400,
                'language' => 'pt-BR',
                'doi' => '10.1234/example.2023.001',
                'issn' => '2345-6789',
                'download_count' => 187,
                'view_count' => 523,
                'is_featured' => true,
                'main_author_id' => $this->getIdByName($authors, 'Dr. Carlos Silva'),
                'other_authors' => [$this->getIdByName($authors, 'Dra. Mariana Costa')],
                'keywords' => ['Inteligência Artificial', 'Machine Learning', 'Deep Learning', 'Automação Industrial', 'Indústria 4.0'],
            ],
            [
                'title' => 'Biodiversidade em ecossistemas marinhos tropicais: um estudo comparativo',
                'abstract' => 'Pesquisa sobre a diversidade biológica em diferentes ecossistemas marinhos tropicais, analisando padrões de distribuição e fatores que afetam a biodiversidade. Este estudo compara dados coletados em várias regiões costeiras e apresenta insights sobre conservação ambiental.',
                'publication_date' => '2023-05-05',
                'user_id' => $users[2]->id ?? $users[0]->id,
                'knowledge_area_id' => $this->getIdBySlug($knowledgeAreas, 'ciencias-biologicas'),
                'publication_type_id' => $this->getIdBySlug($publicationTypes, 'dissertacao'),
                'page_count' => 45,
                'file_type' => 'pdf',
                'file_size' => 3800,
                'language' => 'pt-BR',
                'doi' => '10.1234/example.2023.002',
                'download_count' => 246,
                'view_count' => 418,
                'is_featured' => true,
                'main_author_id' => $this->getIdByName($authors, 'Dra. Ana Oliveira'),
                'other_authors' => [],
                'keywords' => ['Biodiversidade', 'Ecossistemas Marinhos', 'Conservação Ambiental'],
            ],
            [
                'title' => 'Ética na era da inteligência artificial: dilemas contemporâneos',
                'abstract' => 'Uma análise filosófica sobre questões éticas surgidas com o avanço da inteligência artificial, abordando temas como privacidade, autonomia e responsabilidade. O texto examina os impactos sociais e morais do uso crescente de IA em diversos setores.',
                'publication_date' => '2023-04-28',
                'user_id' => $users[3]->id ?? $users[0]->id,
                'knowledge_area_id' => $this->getIdBySlug($knowledgeAreas, 'ciencias-humanas'),
                'publication_type_id' => $this->getIdBySlug($publicationTypes, 'artigo-cientifico'),
                'page_count' => 28,
                'file_type' => 'pdf',
                'file_size' => 1700,
                'language' => 'pt-BR',
                'doi' => '10.1234/example.2023.003',
                'download_count' => 142,
                'view_count' => 356,
                'is_featured' => false,
                'main_author_id' => $this->getIdByName($authors, 'Prof. Ricardo Mendes'),
                'other_authors' => [],
                'keywords' => ['Ética', 'Filosofia Contemporânea', 'Tecnologia', 'Inteligência Artificial'],
            ],
            [
                'title' => 'Sistemas de visão computacional para controle de qualidade industrial',
                'abstract' => 'Este artigo apresenta uma revisão dos sistemas de visão computacional aplicados ao controle de qualidade em ambientes industriais, destacando avanços recentes e desafios. São discutidas as principais técnicas, algoritmos e aplicações práticas.',
                'publication_date' => '2023-03-15',
                'user_id' => $users[1]->id ?? $users[0]->id,
                'knowledge_area_id' => $this->getIdBySlug($knowledgeAreas, 'engenharias'),
                'publication_type_id' => $this->getIdBySlug($publicationTypes, 'artigo-cientifico'),
                'page_count' => 22,
                'file_type' => 'pdf',
                'file_size' => 1900,
                'language' => 'pt-BR',
                'doi' => '10.1234/example.2023.004',
                'download_count' => 156,
                'view_count' => 278,
                'is_featured' => false,
                'main_author_id' => $this->getIdByName($authors, 'Dra. Mariana Costa'),
                'other_authors' => [$this->getIdByName($authors, 'Dr. Carlos Silva')],
                'keywords' => ['Visão Computacional', 'Controle de Qualidade', 'Indústria 4.0', 'Automação Industrial'],
            ],
        ];
        
        // Insert publications and relationships
        foreach ($publications as $publication) {
            // Create the publication
            $publicationId = DB::table('publications')->insertGetId([
                'title' => $publication['title'],
                'slug' => Str::slug($publication['title']),
                'abstract' => $publication['abstract'],
                'publication_date' => $publication['publication_date'],
                'user_id' => $publication['user_id'],
                'knowledge_area_id' => $publication['knowledge_area_id'],
                'publication_type_id' => $publication['publication_type_id'],
                'page_count' => $publication['page_count'],
                'file_path' => 'files/publications/' . Str::slug($publication['title']) . '.' . $publication['file_type'],
                'file_type' => $publication['file_type'],
                'file_size' => $publication['file_size'],
                'language' => $publication['language'] ?? 'pt-BR',
                'doi' => $publication['doi'] ?? null,
                'issn' => $publication['issn'] ?? null,
                'download_count' => $publication['download_count'],
                'view_count' => $publication['view_count'],
                'is_featured' => $publication['is_featured'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Associate main author
            DB::table('author_publication')->insert([
                'author_id' => $publication['main_author_id'],
                'publication_id' => $publicationId,
                'is_main_author' => true,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Associate other authors
            $order = 2;
            foreach ($publication['other_authors'] as $authorId) {
                DB::table('author_publication')->insert([
                    'author_id' => $authorId,
                    'publication_id' => $publicationId,
                    'is_main_author' => false,
                    'order' => $order++,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            // Associate keywords
            foreach ($publication['keywords'] as $keywordName) {
                $keywordId = DB::table('keywords')->where('name', $keywordName)->first()->id ?? null;
                
                if ($keywordId) {
                    DB::table('keyword_publication')->insert([
                        'keyword_id' => $keywordId,
                        'publication_id' => $publicationId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        
        // Add some related publications
        $publication1 = DB::table('publications')->where('slug', Str::slug('Avanços em Inteligência Artificial: aplicações na indústria 4.0'))->first();
        $publication4 = DB::table('publications')->where('slug', Str::slug('Sistemas de visão computacional para controle de qualidade industrial'))->first();
        $publication3 = DB::table('publications')->where('slug', Str::slug('Ética na era da inteligência artificial: dilemas contemporâneos'))->first();
        
        if ($publication1 && $publication4) {
            DB::table('publication_related')->insert([
                'publication_id' => $publication1->id,
                'related_id' => $publication4->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            DB::table('publication_related')->insert([
                'publication_id' => $publication4->id,
                'related_id' => $publication1->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        if ($publication1 && $publication3) {
            DB::table('publication_related')->insert([
                'publication_id' => $publication1->id,
                'related_id' => $publication3->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            DB::table('publication_related')->insert([
                'publication_id' => $publication3->id,
                'related_id' => $publication1->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    
    /**
     * Get ID by slug from a collection.
     */
    private function getIdBySlug($collection, $slug)
    {
        foreach ($collection as $item) {
            if ($item->slug === $slug) {
                return $item->id;
            }
        }
        
        return $collection[0]->id;
    }
    
    /**
     * Get author ID by name.
     */
    private function getIdByName($collection, $name)
    {
        foreach ($collection as $item) {
            if ($item->name === $name) {
                return $item->id;
            }
        }
        
        return $collection[0]->id;
    }
} 