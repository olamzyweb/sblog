<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds a nullable JSON 'tags' column to news_posts.
     * Existing posts are unaffected (null by default).
     */
    public function up(): void
    {
        Schema::table('news_posts', function (Blueprint $table) {
            $table->json('tags')->nullable()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_posts', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
};
