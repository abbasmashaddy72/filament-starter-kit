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
        Schema::create('quiz_topic_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_topic_id')->constrained('quiz_topics')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('media_id')->constrained('media')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_topic_media');
    }
};
