<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('keywords')) {
            Schema::create('keywords', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('keyword_publication')) {
            Schema::create('keyword_publication', function (Blueprint $table) {
                $table->id();
                $table->foreignId('keyword_id')->constrained()->onDelete('cascade');
                $table->foreignId('publication_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('keyword_publication');
        Schema::dropIfExists('keywords');
    }
};
