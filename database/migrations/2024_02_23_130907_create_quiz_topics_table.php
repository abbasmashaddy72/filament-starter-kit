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
        Schema::create('quiz_topics', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->json('title');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->boolean('is_age_restricted')->default(0);
            $table->bigInteger('total_question_count')->nullable();
            $table->json('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_topics');
    }
};
