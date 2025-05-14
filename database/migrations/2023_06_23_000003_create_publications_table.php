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
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
}; 