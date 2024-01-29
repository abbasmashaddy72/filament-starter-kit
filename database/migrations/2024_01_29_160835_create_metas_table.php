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
        Schema::create('metas', function (Blueprint $table) {
            $table->id();
            $table->unique(['metaable_id', 'metaable_type']);
            $table->string('title');
            $table->text('description');
            $table->boolean('indexable')->default(true);
            $table->foreignId('og_image')->nullable();
            $table->integer('metaable_id');
            $table->string('metaable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metas');
    }
};
