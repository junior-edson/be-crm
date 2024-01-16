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
        Schema::table('teams', function (Blueprint $table) {
            $table->string('website')->after('personal_team');
            $table->string('phone')->after('personal_team');
            $table->string('email')->after('personal_team');
            $table->text('address')->after('personal_team');
            $table->string('registration_code')->after('personal_team');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('website');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('address');
            $table->dropColumn('registration_code');
        });
    }
};
