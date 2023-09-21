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
        Schema::create('student_talk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('university_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('details')->nullable(true);
            $table->string('other_details')->nullable(true);
            $table->string('meta_title')->nullable(true);
            $table->string('meta_description')->nullable(true);
            $table->string('meta_keywords')->nullable(true);            
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('country_id', 'FK_CountryIdWithStudentTalk')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithStudentTalk')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('university_id', 'FK_UniversityIdWithUniversities')->references('id')->on('universities')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id', 'FK_USERIDWithStudentTalk')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('cat_id', 'FK_cat_idWithStudentTalk')->references('id')->on('student_talk_category')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_talk');
    }
};
