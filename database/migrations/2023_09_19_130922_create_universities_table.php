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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('slug');
            $table->string('website');
            $table->string('education_field');
            $table->string('message');
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('country_id', 'FK_CountryIdWithUniversities')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithUniversities')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id', 'FK_USERIDWithUniversities')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('cat_id', 'FK_cat_idWithUniversities')->references('id')->on('student_talk_category')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
