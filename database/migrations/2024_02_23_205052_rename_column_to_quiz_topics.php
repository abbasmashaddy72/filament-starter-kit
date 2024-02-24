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
        Schema::table('quiz_topics', function (Blueprint $table) {
            $table->renameColumn('description', 'content');
            $table->json('excerpt')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_topics', function (Blueprint $table) {
            $table->renameColumn('content', 'description');
            $table->dropColumn('excerpt');
        });
    }
};
