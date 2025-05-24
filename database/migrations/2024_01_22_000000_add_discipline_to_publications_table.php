<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->string('discipline')->after('title')->nullable();
            $table->string('course')->after('title')->nullable();
        });
    }

    public function down()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn('discipline');
            $table->dropColumn('course');
        });
    }
};
