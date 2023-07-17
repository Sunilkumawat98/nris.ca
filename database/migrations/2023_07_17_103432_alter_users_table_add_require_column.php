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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('name');
            $table->tinyInteger('is_email_verify')->after('email_verified_at');
            $table->string('dob')->after('is_email_verify');
            $table->string('mobile')->after('dob');
            $table->string('google_id')->after('mobile');
            $table->string('facebook_id')->after('google_id');
            $table->string('twitter_id')->after('facebook_id');
            $table->tinyInteger('is_live')->default(1)->after('remember_token');
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
            $table->dropColumn('is_email_verify');
            $table->dropColumn('dob');
            $table->dropColumn('mobile');
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
            $table->dropColumn('twitter_id');
            $table->dropSoftDeletes();
            $table->dropColumn('is_live');
            $table->dropColumn('status');
        });
    }
};
