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
        Schema::table('users', function (Blueprint $table) {
            $table->string('institution')->nullable()->after('email');
            $table->string('role')->default('user')->after('institution');
            $table->string('academic_title')->nullable()->after('role');
            $table->string('department')->nullable()->after('academic_title');
            $table->string('orcid')->nullable()->after('department');
            $table->text('bio')->nullable()->after('orcid');
            $table->string('profile_photo_path')->nullable()->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'institution',
                'role',
                'academic_title',
                'department',
                'orcid',
                'bio',
                'profile_photo_path'
            ]);
        });
    }
}; 