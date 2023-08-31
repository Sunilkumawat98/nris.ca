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
        Schema::table('nris_talk', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->after('description');
            $table->foreign('country_id', 'FK_NRISTALKWITHCOUNTRYID')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('nris_talk_reply', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->after('comment');
            $table->foreign('country_id', 'FK_NRISTALKREPLYWITHCOUNTRYID')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::create('nris_talk_like', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('talk_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('talk_id', 'FK_NRISTALKLIKEWITHTALKID')->references('id')->on('nris_talk')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id', 'FK_NRISTALKLIKEWITHUSERID')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('country_id', 'FK_NRISTALKLIKEWITHCOUNTRYID')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_NRISTALKLIKEWITHSTATEID')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nris_talk', function (Blueprint $table) {
            $table->dropForeign('FK_NRISTALKWITHCOUNTRYID'); // Replace with the actual foreign key name
            $table->dropColumn('country_id');
        });

        Schema::table('nris_talk_reply', function (Blueprint $table) {
            $table->dropForeign('FK_NRISTALKREPLYWITHCOUNTRYID'); // Replace with the actual foreign key name
            $table->dropColumn('country_id');
        });

        Schema::dropIfExists('nris_talk_like');
    }
};
