<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Knowledge Areas table
        if (!Schema::hasTable('knowledge_areas')) {
            Schema::create('knowledge_areas', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->string('color_class')->nullable()->comment('CSS color class for UI display');
                $table->string('icon_path')->nullable();
                $table->integer('publication_count')->default(0)->comment('Cache for publication count');
                $table->timestamps();
            });
        }

        // Knowledge Subareas table
        if (!Schema::hasTable('knowledge_subareas')) {
            Schema::create('knowledge_subareas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('knowledge_area_id')->constrained()->onDelete('cascade');
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        // Publication Types table
        if (!Schema::hasTable('publication_types')) {
            Schema::create('publication_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        // Authors table
        if (!Schema::hasTable('authors')) {
            Schema::create('authors', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->nullable();
                $table->string('institution')->nullable();
                $table->string('orcid')->nullable()->comment('ORCID identifier');
                $table->text('bio')->nullable();
                $table->string('profile_photo_path')->nullable();
                $table->timestamps();
            });
        }

        // Publications table
        if (!Schema::hasTable('publications')) {
            Schema::create('publications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('knowledge_area_id')->constrained()->onDelete('restrict');
                $table->foreignId('publication_type_id')->constrained()->onDelete('restrict');
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('abstract');
                $table->date('publication_date');
                $table->integer('page_count')->nullable();
                $table->string('file_path');
                $table->string('file_type');
                $table->integer('file_size')->comment('Size in KB');
                $table->string('language')->default('pt-BR');
                $table->string('doi')->nullable()->comment('Digital Object Identifier');
                $table->string('issn')->nullable();
                $table->integer('download_count')->default(0);
                $table->integer('view_count')->default(0);
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }

        // Author Publication pivot table
        if (!Schema::hasTable('author_publication')) {
            Schema::create('author_publication', function (Blueprint $table) {
                $table->id();
                $table->foreignId('author_id')->constrained()->onDelete('cascade');
                $table->foreignId('publication_id')->constrained()->onDelete('cascade');
                $table->boolean('is_main_author')->default(false);
                $table->integer('order')->default(0);
                $table->timestamps();
            });
        }

        // Keywords table
        if (!Schema::hasTable('keywords')) {
            Schema::create('keywords', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->timestamps();
            });
        }

        // Publication Keyword pivot table
        if (!Schema::hasTable('keyword_publication')) {
            Schema::create('keyword_publication', function (Blueprint $table) {
                $table->id();
                $table->foreignId('keyword_id')->constrained()->onDelete('cascade');
                $table->foreignId('publication_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }

        // Comments table
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('publication_id')->constrained()->onDelete('cascade');
                $table->text('content');
                $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
                $table->boolean('is_approved')->default(true);
                $table->timestamps();
            });
        }

        // Publication Previews table
        if (!Schema::hasTable('publication_previews')) {
            Schema::create('publication_previews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('publication_id')->constrained()->onDelete('cascade');
                $table->string('preview_path');
                $table->integer('page_number');
                $table->timestamps();
            });
        }

        // Publication Related Publications pivot table
        if (!Schema::hasTable('publication_related')) {
            Schema::create('publication_related', function (Blueprint $table) {
                $table->id();
                $table->foreignId('publication_id')->constrained()->onDelete('cascade');
                $table->foreignId('related_id')->constrained('publications')->onDelete('cascade');
                $table->timestamps();
                
                $table->unique(['publication_id', 'related_id']);
            });
        }

        // User Profiles - extend Laravel users table
        if (!Schema::hasTable('user_profiles')) {
            Schema::create('user_profiles', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
                $table->string('institution')->nullable();
                $table->string('academic_title')->nullable();
                $table->text('bio')->nullable();
                $table->string('orcid')->nullable();
                $table->string('lattes_url')->nullable();
                $table->string('website')->nullable();
                $table->string('social_github')->nullable();
                $table->string('social_linkedin')->nullable();
                $table->string('social_twitter')->nullable();
                $table->string('social_facebook')->nullable();
                $table->string('profile_visibility')->default('public')->comment('public, private, or connections');
                $table->timestamps();
            });
        }

        // Activity Logs table
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                $table->string('log_type');
                $table->string('action');
                $table->text('description');
                $table->morphs('loggable');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
            });
        }

        // User Bookmarks pivot table
        if (!Schema::hasTable('user_bookmarks')) {
            Schema::create('user_bookmarks', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('publication_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                
                $table->unique(['user_id', 'publication_id']);
            });
        }

        // User Download History table
        if (!Schema::hasTable('user_downloads')) {
            Schema::create('user_downloads', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                $table->foreignId('publication_id')->constrained()->onDelete('cascade');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables in reverse order to avoid foreign key constraints
        Schema::dropIfExists('user_downloads');
        Schema::dropIfExists('user_bookmarks');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('publication_related');
        Schema::dropIfExists('publication_previews');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('keyword_publication');
        Schema::dropIfExists('keywords');
        Schema::dropIfExists('author_publication');
        Schema::dropIfExists('publications');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('publication_types');
        Schema::dropIfExists('knowledge_subareas');
        Schema::dropIfExists('knowledge_areas');
    }
}; 