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
            $table->date('person_dob')->nullable()->after('person_contact_no');
            $table->string('gender')->nullable()->change();
            $table->dropColumn('self_enroll');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_users', function (Blueprint $table) {
            $table->dropColumn('person_dob');
            $table->boolean('self_enroll')->default(0)->after('self_or_else');
            $table->string('gender')->default('Male')->change();
        });
    }
};
