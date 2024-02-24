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
        Schema::create('quiz_users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique()->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->boolean('self_enroll')->default(0);
            $table->boolean('self_or_else')->default(0);
            $table->string('person_name')->nullable();
            $table->string('person_father_name')->nullable();
            $table->string('person_contact_no')->nullable();
            $table->date('dob')->nullable();
            $table->string('location')->nullable();
            $table->string('gender')->default('Male');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_users');
    }
};
