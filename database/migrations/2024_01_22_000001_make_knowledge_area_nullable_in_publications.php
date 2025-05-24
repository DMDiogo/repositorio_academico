<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->foreignId('knowledge_area_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->foreignId('knowledge_area_id')->nullable(false)->change();
        });
    }
};
