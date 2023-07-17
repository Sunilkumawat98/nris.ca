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

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color', 10);
            $table->string('code', 5);
            $table->string('domain', 50);
            $table->string('image');
            $table->text('c_meta_title');
            $table->text('c_meta_description');
            $table->text('c_meta_keywords');
            $table->string('created_by')->default('NULL');
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
        });

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 5);
            $table->string('domain', 50);
            $table->unsignedBigInteger('country_id');
            $table->text('description');
            $table->string('logo')->default('NULL');
            $table->text('s_meta_title');
            $table->text('s_meta_description');
            $table->text('s_meta_keywords');
            $table->string('header_image')->default('NULL');
            $table->string('header_image2')->default('NULL');
            $table->string('header_image3')->default('NULL');
            $table->string('created_by')->default('NULL');
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('country_id', 'FK_CountryIdWithCountryTable')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 5);
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->string('state_code', 10);
            $table->string('created_by')->default('NULL');
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('country_id', 'FK_CountryIdCityWithCountryTable')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdCityWithStateTable')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
        });


        Schema::create('nris_talk', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('title-slug');
            $table->text('description');
            $table->string('state_id');
            $table->unsignedBigInteger('user_id');
            $table->text('meta_title');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->string('total_views');
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('user_id', 'FK_UserIdWithUsers')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
        Schema::dropIfExists('states');        
        Schema::dropIfExists('countries');
        Schema::dropIfExists('nris_talk');
    }
};
