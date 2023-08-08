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
        Schema::create('desi_movies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->text('address')->nullable(true);
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable(true);
            $table->string('url')->nullable(true);
            $table->text('image')->nullable(true);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('additional_info')->nullable(true);            
            $table->text('meta_title')->nullable(true);
            $table->text('meta_description')->nullable(true);
            $table->text('meta_keywords')->nullable(true);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('country_id', 'FK_CountryIdWithDesiMovies')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithDesiMovies')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('city_id', 'FK_CityIdWithDesiMovies')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desi_movies');
    }
};
