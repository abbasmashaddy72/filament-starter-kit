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
        Schema::table('quiz_users', function (Blueprint $table) {
            $table->dropColumn('self_or_else');
            $table->string('enrollment_type')->default('none')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_users', function (Blueprint $table) {
            $table->dropColumn('enrollment_type');
            $table->boolean('self_or_else')->default(0)->after('email');
        });
    }
};
