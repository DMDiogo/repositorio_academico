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

        Schema::create('author_publication', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->foreignId('publication_id')->constrained()->onDelete('cascade');
            $table->boolean('is_main_author')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_publication');
        Schema::dropIfExists('authors');
    }
}; 