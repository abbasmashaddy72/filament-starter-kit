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
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_user_id')->constrained('quiz_users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('quiz_topic_id')->constrained('quiz_topics')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('quiz_question_id')->constrained('quiz_questions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('quiz_option_id')->constrained('quiz_options')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('correct');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
