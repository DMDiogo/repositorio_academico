<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            KnowledgeAreaSeeder::class,
            PublicationTypeSeeder::class,
            UserSeeder::class,
            AuthorSeeder::class,
            PublicationSeeder::class,
        ]);
    }
}
